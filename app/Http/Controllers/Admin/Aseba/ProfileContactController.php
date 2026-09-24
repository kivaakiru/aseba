<?php

namespace App\Http\Controllers\Admin\Aseba;

use App\Http\Controllers\Controller;
use App\Models\ProfileContact;
use Illuminate\Http\Request;

class ProfileContactController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $addresses = ProfileContact::where('type', 'address')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $socials = ProfileContact::where('type', '!=', 'address')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view(
            'admin.profile.kontak',
            compact(
                'addresses',
                'socials'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE ADDRESS
    |--------------------------------------------------------------------------
    */

    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'label' => [
                'required',
                'string',
                'max:150',
            ],

            'value' => [
                'required',
                'string',
                'max:2000',
            ],

            'link' => [
                'required',
                'url',
                'max:2000',
            ],
        ], [

            'label.required' =>
                'Nama lokasi / nama tempat wajib diisi.',

            'value.required' =>
                'Alamat wajib diisi.',

            'link.required' =>
                'Link Google Maps wajib diisi.',

            'link.url' =>
                'Link Google Maps harus berupa URL yang valid.',
        ]);

        $sortOrder = ProfileContact::where(
            'type',
            'address'
        )->max('sort_order');

        ProfileContact::create([

            'type' => 'address',

            'label' => $validated['label'],

            'value' => $validated['value'],

            'link' => $validated['link'],

            'sort_order' => is_null($sortOrder)
                ? 0
                : $sortOrder + 1,
        ]);

        return back()->with(
            'success',
            'Alamat berhasil ditambahkan.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE SOCIAL
    |--------------------------------------------------------------------------
    */

    public function storeSocial(Request $request)
    {
        $validated = $request->validate([

            'type' => [
                'required',
                'in:instagram,facebook,tiktok,youtube,x,whatsapp,telegram,email,website',
            ],

            'link' => [
                'required',
                'string',
                'max:2000',
            ],

        ], [

            'type.required' =>
                'Jenis sosial media wajib dipilih.',

            'link.required' =>
                'Link, username, email atau nomor wajib diisi.',
        ]);

        $data = $this->normalizeSocial(
            $validated['type'],
            $validated['link']
        );

        $sortOrder = ProfileContact::where(
            'type',
            '!=',
            'address'
        )->max('sort_order');

        ProfileContact::create([

            'type' => $validated['type'],

            'label' => null,

            'value' => $data['value'],

            'link' => $data['link'],

            'sort_order' => is_null($sortOrder)
                ? 0
                : $sortOrder + 1,
        ]);

        return back()->with(
            'success',
            'Sosial media berhasil ditambahkan.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $contact = ProfileContact::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | ADDRESS
        |--------------------------------------------------------------------------
        */

        if ($contact->type === 'address') {

            $validated = $request->validate([

                'label' => [
                    'required',
                    'string',
                    'max:150',
                ],

                'value' => [
                    'required',
                    'string',
                    'max:2000',
                ],

                'link' => [
                    'required',
                    'url',
                    'max:2000',
                ],

            ], [

                'label.required' =>
                    'Nama lokasi / nama tempat wajib diisi.',

                'value.required' =>
                    'Alamat wajib diisi.',

                'link.required' =>
                    'Link Google Maps wajib diisi.',

                'link.url' =>
                    'Link Google Maps harus berupa URL yang valid.',
            ]);

            $contact->update([

                'label' => $validated['label'],

                'value' => $validated['value'],

                'link' => $validated['link'],
            ]);

            return back()->with(
                'success',
                'Alamat berhasil diperbarui.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SOCIAL
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'type' => [
                'required',
                'in:instagram,facebook,tiktok,youtube,x,whatsapp,telegram,email,website',
            ],

            'link' => [
                'required',
                'string',
                'max:2000',
            ],

        ], [

            'type.required' =>
                'Jenis sosial media wajib dipilih.',

            'link.required' =>
                'Link, username, email atau nomor wajib diisi.',
        ]);

        $data = $this->normalizeSocial(
            $validated['type'],
            $validated['link']
        );

        $contact->update([

            'type' => $validated['type'],

            'label' => null,

            'value' => $data['value'],

            'link' => $data['link'],
        ]);

        return back()->with(
            'success',
            'Sosial media berhasil diperbarui.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $contact = ProfileContact::findOrFail($id);

        $contact->delete();

        return back()->with(
            'success',
            'Data berhasil dihapus.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | REORDER
    |--------------------------------------------------------------------------
    */

    public function reorder(Request $request)
    {
        $validated = $request->validate([

            'items' => [
                'required',
                'array',
            ],

            'items.*.id' => [
                'required',
                'integer',
                'exists:profile_contacts,id',
            ],

            'items.*.sort_order' => [
                'required',
                'integer',
                'min:0',
            ],
        ]);

        foreach ($validated['items'] as $item) {

            ProfileContact::where(
                'id',
                $item['id']
            )->update([

                'sort_order' =>
                    $item['sort_order'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Urutan berhasil disimpan.',
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | NORMALIZE SOCIAL
    |--------------------------------------------------------------------------
    */

    private function normalizeSocial(
        string $type,
        string $input
    ): array {

        $input = trim($input);

        /*
        |--------------------------------------------------------------------------
        | EMAIL
        |--------------------------------------------------------------------------
        */

        if ($type === 'email') {

            $email = preg_replace(
                '/^mailto:/i',
                '',
                $input
            );

            $email = trim($email);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                abort(
                    422,
                    'Format email tidak valid.'
                );
            }

            return [

                'value' => $email,

                'link' => 'mailto:' . $email,
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | WHATSAPP
        |--------------------------------------------------------------------------
        */

        if ($type === 'whatsapp') {

            $number = preg_replace(
                '/\D+/',
                '',
                $input
            );

            if (str_starts_with($number, '0')) {

                $number =
                    '62'
                    . substr(
                        $number,
                        1
                    );
            }

            return [

                'value' => $number,

                'link' =>
                    'https://wa.me/'
                    . $number,
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | TELEGRAM
        |--------------------------------------------------------------------------
        */

        if ($type === 'telegram') {

            $username = $this->extractUsername(
                $input
            );

            $username = ltrim(
                $username,
                '@'
            );

            return [

                'value' =>
                    '@' . $username,

                'link' =>
                    'https://t.me/'
                    . $username,
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | INSTAGRAM
        |--------------------------------------------------------------------------
        */

        if ($type === 'instagram') {

            $username = $this->extractUsername(
                $input
            );

            $username = ltrim(
                $username,
                '@'
            );

            return [

                'value' =>
                    '@' . $username,

                'link' =>
                    'https://instagram.com/'
                    . $username,
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | TIKTOK
        |--------------------------------------------------------------------------
        */

        if ($type === 'tiktok') {

            $username = $this->extractUsername(
                $input
            );

            $username = ltrim(
                $username,
                '@'
            );

            return [

                'value' =>
                    '@' . $username,

                'link' =>
                    'https://tiktok.com/@'
                    . $username,
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | X
        |--------------------------------------------------------------------------
        */

        if ($type === 'x') {

            $username = $this->extractUsername(
                $input
            );

            $username = ltrim(
                $username,
                '@'
            );

            return [

                'value' =>
                    '@' . $username,

                'link' =>
                    'https://x.com/'
                    . $username,
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | FACEBOOK
        |--------------------------------------------------------------------------
        */

        if ($type === 'facebook') {

            $username = $this->extractUsername(
                $input
            );

            $username = ltrim(
                $username,
                '@'
            );

            return [

                'value' =>
                    $username,

                'link' =>
                    'https://facebook.com/'
                    . $username,
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | YOUTUBE
        |--------------------------------------------------------------------------
        */

        if ($type === 'youtube') {

            $username = $this->extractUsername(
                $input
            );

            $username = ltrim(
                $username,
                '@'
            );

            return [

                'value' =>
                    '@' . $username,

                'link' =>
                    str_starts_with(
                        $input,
                        'http'
                    )
                        ? $input
                        : 'https://youtube.com/@'
                            . $username,
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | WEBSITE
        |--------------------------------------------------------------------------
        */

        if ($type === 'website') {

            $url = $input;

            if (!preg_match(
                '/^https?:\/\//i',
                $url
            )) {

                $url =
                    'https://'
                    . $url;
            }

            $parsed = parse_url($url);

            $value =
                $parsed['host']
                ?? $url;

            return [

                'value' => $value,

                'link' => $url,
            ];
        }


        return [

            'value' => $input,

            'link' => $input,
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | EXTRACT USERNAME
    |--------------------------------------------------------------------------
    */

    private function extractUsername(
        string $input
    ): string {

        $input = trim($input);

        /*
        |--------------------------------------------------------------------------
        | Username langsung
        |--------------------------------------------------------------------------
        */

        if (!preg_match(
            '/^https?:\/\//i',
            $input
        )) {

            $input = ltrim(
                $input,
                '@'
            );

            return trim(
                explode(
                    '/',
                    $input
                )[0]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | URL
        |--------------------------------------------------------------------------
        */

        $path = parse_url(
            $input,
            PHP_URL_PATH
        );

        $path = trim(
            (string) $path,
            '/'
        );

        $segments = array_values(
            array_filter(
                explode(
                    '/',
                    $path
                )
            )
        );

        if (empty($segments)) {

            return '';
        }


        /*
        |--------------------------------------------------------------------------
        | YouTube /channel/...
        |--------------------------------------------------------------------------
        */

        if (
            isset($segments[0])
            &&
            in_array(
                strtolower($segments[0]),
                [
                    'channel',
                    'c',
                    'user',
                ],
                true
            )
            &&
            isset($segments[1])
        ) {

            return ltrim(
                $segments[1],
                '@'
            );
        }


        return ltrim(
            $segments[0],
            '@'
        );
    }
}