<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Salon;
use App\Models\Business;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Aer Conditionat',
            'Artificii Exterior',
            'Autorizatie DSP',
            'Autorizatie ISU',
            'Bucatarie Proprie',
            'Accepta Catering',
            'Ofera Catering',
            'Cazare Invitati',
            'Cazare Miri',
            'Loc Cununie',
            'Curent 380 V',
            'Fara Taxe Suplimentare',
            'Garderoba',
            'Generator',
            'Gradina',
            'Hostess',
            'Lac',
            'Loc De Fumat',
            'Loc De Joaca',
            'Loc Photo Corner',
            'Padure',
            'Parcare Proprie',
            'Permite bautura din afara locatiei',
            'Piscina',
            'Plata Card',
            'Plata Cash',
            'Posibilitate Barbeque',
            'Ring De Dans Dedicat',
            'Sistem Audio',
            'Taxi/Ridesharing',
            'Transport Invitati',
            'Wireless',
            'Zona Cocktail',
            'Aranjamente Mese Standard',
            'Ring De Dans',
            'Spatiu Acoperit',
            'Terasa',
            'Ballroom',
            'Candy Bar',
            'Live Cooking',
            'Serviciu BBQ',
            'Protap',
        ];

        $tagIcons = config('tag_icons');

        foreach ($tags as $tagName) {
            $iconPath = isset($tagIcons[$tagName]) ? $tagIcons[$tagName] : null;
            Tag::create(['name' => $tagName, 'icon' => $iconPath]);
        }

        $tags = Tag::all();
        $businesses = Business::all();
        $salons = Salon::all();

        foreach ($salons as $salon) {
            $salonTags = $tags->random(20)->pluck('id')->toArray();
            $salon->tags()->attach($salonTags);
        }

        foreach ($businesses as $business) {
            $businessTags = $tags->random(20)->pluck('id')->toArray();
            $business->tags()->attach($businessTags);
        }
    }
}
