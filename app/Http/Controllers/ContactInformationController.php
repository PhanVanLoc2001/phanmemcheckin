<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactInformation;

class ContactInformationController extends Controller
{
    public function edit()
    {
        $contact = ContactInformation::firstOrCreate(['id' => 1], ['name' => 'Cài đặt thông tin']);
        // dd($contact);

        return view('settings.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $contact = ContactInformation::findOrFail($id);
        $contact->update($request->all());

        $banners = $request->input('banner');
        if ($banners) {
            $images = [];

            for ($i = 0; $i < count($banners); $i += 2) {
                $image = $banners[$i];
                $value = isset($banners[$i + 1]) ? $banners[$i + 1] : null;

                $images[] = [
                    'image' => $image,
                    'value' => $value
                ];
            }

            $contact->banner = json_encode($images);
        }
        // dd($contact);
        $contact->save();

        return redirect()->route('settings.edit', ['setting' => 1])->with('success', 'Contact information updated successfully');
    }
}
