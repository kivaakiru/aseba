<?php

namespace App\Exports;

use App\Models\Player;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PlayersExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithDrawings,
    WithStyles,
    WithColumnWidths,
    WithEvents
{
    protected $players;

    /*
    |--------------------------------------------------------------------------
    | DATA
    |--------------------------------------------------------------------------
    */

    public function collection()
    {
        $this->players = Player::with('team')
            ->orderBy('full_name', 'asc')
            ->get();

        return $this->players;
    }

    /*
    |--------------------------------------------------------------------------
    | HEADER
    |--------------------------------------------------------------------------
    */

    public function headings(): array
    {
        return [
            'Foto',
            'Nama Lengkap',
            'Nama Punggung',
            'Nomor Punggung',
            'Tanggal Lahir',
            'Umur',
            'Posisi',
            'Tim',
            'Tinggi Badan',
            'Berat Badan',
            'Status',
            'Nama Sosial Media',
            'Link Sosial Media',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | DATA MAPPING
    |--------------------------------------------------------------------------
    */

    public function map($player): array
    {
        return [
            '',

            $player->full_name ?? '-',

            $player->jersey_name ?? '-',

            $player->jersey_number ?? '-',

            $player->date_of_birth
                ? date('d-m-Y', strtotime($player->date_of_birth))
                : '-',

            $player->age ?? '-',

            $this->positionName($player->position),

            $player->team->name ?? '-',

            $player->height
                ? $player->height . ' CM'
                : '-',

            $player->weight
                ? $player->weight . ' KG'
                : '-',

            ucfirst($player->status ?? '-'),

            $player->social_media_name ?? '-',

            $player->social_media_url ?? '-',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | POSISI
    |--------------------------------------------------------------------------
    */

    private function positionName($position)
    {
        $positions = [
            'PG' => 'Point Guard',
            'SG' => 'Shooting Guard',
            'SF' => 'Small Forward',
            'PF' => 'Power Forward',
            'C'  => 'Center',
        ];

        return $positions[$position] ?? $position ?? '-';
    }

    /*
    |--------------------------------------------------------------------------
    | FOTO PEMAIN
    |--------------------------------------------------------------------------
    */

    public function drawings()
    {
        $drawings = [];

        if (!$this->players) {
            return $drawings;
        }

        foreach ($this->players as $index => $player) {

            if (!$player->photo) {
                continue;
            }

            $path = Storage::disk('public')->path(
                $player->photo
            );

            if (!file_exists($path)) {
                continue;
            }

            $drawing = new Drawing();

            $drawing->setName(
                $player->full_name ?? 'Player'
            );

            $drawing->setDescription(
                'Foto pemain'
            );

            $drawing->setPath($path);

            // Ukuran foto
            $drawing->setHeight(55);

            // Kolom A = Foto
            // Baris 1 = Header
            // Data dimulai dari baris 2
            $drawing->setCoordinates(
                'A' . ($index + 2)
            );

            // Posisi foto di tengah cell
            $drawing->setOffsetX(10);
            $drawing->setOffsetY(5);

            $drawings[] = $drawing;
        }

        return $drawings;
    }

    /*
    |--------------------------------------------------------------------------
    | LEBAR KOLOM
    |--------------------------------------------------------------------------
    */

    public function columnWidths(): array
    {
        return [
            'A' => 12, // Foto
            'B' => 25, // Nama Lengkap
            'C' => 18, // Nama Punggung
            'D' => 16, // Nomor Punggung
            'E' => 18, // Tanggal Lahir
            'F' => 10, // Umur
            'G' => 22, // Posisi
            'H' => 15, // Tim
            'I' => 16, // Tinggi
            'J' => 16, // Berat
            'K' => 14, // Status
            'L' => 22, // Nama Sosial Media
            'M' => 38, // Link Sosial Media
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | STYLE SHEET
    |--------------------------------------------------------------------------
    */

    public function styles(Worksheet $sheet)
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | HEADER
            |--------------------------------------------------------------------------
            */

            1 => [
                'font' => [
                    'bold' => true,
                    'color' => [
                        'rgb' => 'FFFFFF',
                    ],
                    'size' => 11,
                ],

                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => '0F172A',
                    ],
                ],

                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | EVENT EXCEL
    |--------------------------------------------------------------------------
    */

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                $lastRow = $this->players
                    ? $this->players->count() + 1
                    : 1;

                /*
                |--------------------------------------------------------------------------
                | FREEZE HEADER
                |--------------------------------------------------------------------------
                */

                $sheet->freezePane('A2');

                /*
                |--------------------------------------------------------------------------
                | FILTER EXCEL
                |--------------------------------------------------------------------------
                */

                if ($lastRow >= 1) {
                    $sheet->setAutoFilter(
                        'A1:M' . $lastRow
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | TINGGI HEADER
                |--------------------------------------------------------------------------
                */

                $sheet->getRowDimension(1)->setRowHeight(35);

                /*
                |--------------------------------------------------------------------------
                | TINGGI BARIS PEMAIN
                |--------------------------------------------------------------------------
                */

                for ($row = 2; $row <= $lastRow; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(65);
                }

                /*
                |--------------------------------------------------------------------------
                | STYLE SEL DATA
                |--------------------------------------------------------------------------
                */

                if ($lastRow >= 2) {

                    $range = 'A2:M' . $lastRow;

                    $sheet->getStyle($range)->applyFromArray([

                        'alignment' => [
                            'vertical' => Alignment::VERTICAL_CENTER,
                            'wrapText' => true,
                        ],

                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => 'D9E1E8',
                                ],
                            ],
                        ],

                        'font' => [
                            'size' => 10,
                            'color' => [
                                'rgb' => '111827',
                            ],
                        ],
                    ]);

                    /*
                    |--------------------------------------------------------------------------
                    | ALIGNMENT KHUSUS
                    |--------------------------------------------------------------------------
                    */

                    $sheet->getStyle(
                        'A2:A' . $lastRow
                    )->getAlignment()->setHorizontal(
                        Alignment::HORIZONTAL_CENTER
                    );

                    $sheet->getStyle(
                        'D2:F' . $lastRow
                    )->getAlignment()->setHorizontal(
                        Alignment::HORIZONTAL_CENTER
                    );

                    $sheet->getStyle(
                        'G2:K' . $lastRow
                    )->getAlignment()->setHorizontal(
                        Alignment::HORIZONTAL_CENTER
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | STATUS
                    |--------------------------------------------------------------------------
                    */

                    for ($row = 2; $row <= $lastRow; $row++) {

                        $status = $sheet
                            ->getCell('K' . $row)
                            ->getValue();

                        if (strtolower($status) === 'active') {

                            $sheet->getStyle('K' . $row)
                                ->getFont()
                                ->getColor()
                                ->setRGB('16A34A');

                        } elseif (strtolower($status) === 'inactive') {

                            $sheet->getStyle('K' . $row)
                                ->getFont()
                                ->getColor()
                                ->setRGB('DC2626');
                        }
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | LINK SOSIAL MEDIA
                    |--------------------------------------------------------------------------
                    */

                    for ($row = 2; $row <= $lastRow; $row++) {

                        $cell = $sheet->getCell('M' . $row);

                        $url = $cell->getValue();

                        if (
                            $url &&
                            $url !== '-' &&
                            filter_var($url, FILTER_VALIDATE_URL)
                        ) {
                            // Jadikan hyperlink
                            $cell->getHyperlink()->setUrl($url);

                            // Styling harus melalui Style, bukan Cell
                            $sheet->getStyle('M' . $row)
                                ->getFont()
                                ->getColor()
                                ->setRGB('2563EB');

                            $sheet->getStyle('M' . $row)
                                ->getFont()
                                ->setUnderline(true);
                        }
                    }
                }
            },
        ];
    }
}