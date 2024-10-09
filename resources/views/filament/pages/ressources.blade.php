@php $links = [
    [
        'title' => 'Le guide d’animation',
        'url' => 'https://jeveuxaider.notion.site/Guide-d-animation-b4042a944bed46549ae078e21c15f94a',
    ],
    [
        'title' => 'Les documents de formation',
        'url' => 'https://jeveuxaider.notion.site/Formation-animateur-rice-ec0889a029f944799abf1e8f42fd7717',
    ],
    [
        'title' => 'Le matériel nécessaire',
        'url' => 'https://jeveuxaider.notion.site/Checklist-Mat-riel-98c46805a3674a82865c7c4b476795f7',
    ],
    [
        'title' => 'La checklist d’animation d’une fresque',
        'url' => 'https://jeveuxaider.notion.site/Checklist-Mat-riel-98c46805a3674a82865c7c4b476795f7',
    ],
    [
        'title' => 'Le kit de communication',
        'url' => 'https://jeveuxaider.notion.site/Kit-de-com-animateurs-8ea1c7ec07f64088b5b1905e552a4281?pvs=4',
    ],
    [
        'title' => 'FAQ',
        'url' => 'https://reserve-civique.crisp.help/fr/category/fresque-du-benevolat-97jq8c/',
        'description' => 'Vous avez une question ? La réponse est sûrement dans le centre d’aide !'
    ],
]; @endphp

<x-filament-panels::page>

    <div class="grid grid-cols-1 gap-4">

        @foreach($links as $link)
            <div class="bg-white p-6 border rounded-xl flex justify-between items-center gap-4">
                <div>
                    <div class="text-lg font-medium"> {{ $link['title'] }}</div>
                    @if(isset($link['description']))
                        <div class="text-sm text-gray-500 mt-2"> {{ $link['description'] }}</div>
                    @endif
                </div>
                <div>
                    <x-filament::button
                        outlined
                        icon="heroicon-o-arrow-top-right-on-square"
                        icon-position="after"
                        tag="a"
                        target="_blank"
                        href="{{ $link['url'] }}">
                        Ouvrir
                    </x-filament::button>
                </div>
            </div>
        @endforeach

        <div class="bg-white p-6 border rounded-xl flex justify-between items-center gap-4">
        <div>
        <div class="text-lg font-medium">Vous ne trouvez pas ce que vous cherchez ?</div>
        <div class="text-sm text-gray-500 mt-2">Ecrivez-nous directement sur l’adresse <strong>supportfresque@jeveuxaider.beta.gouv.fr</strong></div>
        </div>
        
    </div>

</x-filament-panels::page>