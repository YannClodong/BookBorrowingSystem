@extends('layouts.main')

@section('content')
    <h1 class="display-4 mb-4 text-primary">Add a book to the library</h1>
    <form action="{{ $response_url }}" method="POST">
        @csrf
        @method($response_method)

        <div class="form-floating mb-3">
            <input type="text"
                   class="form-control @error('title') is-invalid @enderror"
                   id="title"
                   name="title"
                   placeholder="Title..."
                   value="{{ old('title', $book?->title ?? '') }}">
            <label for="title">Book title</label>
            <div class="invalid-feedback">
                Please enter a title, its size must be between 3 and 255.
            </div>
        </div>
        <div class="form-floating mb-3">
            <input type="text"
                   class="form-control @error('authors') is-invalid @enderror"
                   id="authors"
                   name="authors"
                   placeholder="Authors..."
                   value="{{ old('authors', $book?->authors ?? '') }}">
            <label for="authors">Book authors</label>
            <div class="invalid-feedback">
                Please enter a authors, its size must be between 3 and 255.
            </div>
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control @error('description') is-invalid @enderror"
                      id="description"
                      name="description"
                      placeholder="Description..."
                      style="height: 200px"
            >{{ old('description', $book?->description ?? '') }}</textarea>
            <label for="description">Book description</label>
        </div>
        <div class="form-floating mb-3">
            <input type="date"
                   class="form-control @error('released_at') is-invalid @enderror"
                   id="released_at"
                   name="released_at"
                   placeholder="Released at..."
                   value="{{ old('released_at', $book?->released_at ?? '') }}">
            <label for="released_at">Release date</label>
        </div>
        <div class="invalid-feedback">
            Please enter a release date.
        </div>
        <div class="form-floating mb-3">
            <input type="text"
                   class="form-control @error('cover_image') is-invalid @enderror"
                   id="cover_image"
                   name="cover_image"
                   placeholder="Cover image..."
                   value="{{ old('cover_image', $book?->cover_image ?? '') }}">
            <label for="cover_image">Book cover image</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number"
                   class="form-control @error('pages') is-invalid @enderror"
                   id="pages"
                   name="pages"
                   placeholder="Number of pages..."
                   value="{{ old('pages', $book?->pages ?? '') }}">
            <label for="pages">Number of page</label>
            <div class="invalid-feedback">
                Please enter a number of pages, it must be greater than 1.
            </div>
        </div>
        <div class="form-floating mb-3">
            <select
                class="form-control @error('language_code') is-invalid @enderror"
                id="language_code"
                name="language_code"
            >
                <!-- $oldLanguage => old('language_code', $book?->language_code ?? 'hu') -->
                <?php
                $oldLanguage = old('language_code', $book?->language_code ?? 'hu')
                ?>

                <option {{ $oldLanguage == 'ab' ? 'selected' : '' }} value="ab">Abkhazian (ab)</option>
                <option {{ $oldLanguage == 'aa' ? 'selected' : '' }} value="aa">Afar (aa)</option>
                <option {{ $oldLanguage == 'af' ? 'selected' : '' }} value="af">Afrikaans (af)</option>
                <option {{ $oldLanguage == 'ak' ? 'selected' : '' }} value="ak">Akan (ak)</option>
                <option {{ $oldLanguage == 'sq' ? 'selected' : '' }} value="sq">Albanian (sq)</option>
                <option {{ $oldLanguage == 'am' ? 'selected' : '' }} value="am">Amharic (am)</option>
                <option {{ $oldLanguage == 'ar' ? 'selected' : '' }} value="ar">Arabic (ar)</option>
                <option {{ $oldLanguage == 'an' ? 'selected' : '' }} value="an">Aragonese (an)</option>
                <option {{ $oldLanguage == 'hy' ? 'selected' : '' }} value="hy">Armenian (hy)</option>
                <option {{ $oldLanguage == 'as' ? 'selected' : '' }} value="as">Assamese (as)</option>
                <option {{ $oldLanguage == 'av' ? 'selected' : '' }} value="av">Avaric (av)</option>
                <option {{ $oldLanguage == 'ae' ? 'selected' : '' }} value="ae">Avestan (ae)</option>
                <option {{ $oldLanguage == 'ay' ? 'selected' : '' }} value="ay">Aymara (ay)</option>
                <option {{ $oldLanguage == 'az' ? 'selected' : '' }} value="az">Azerbaijani (az)</option>
                <option {{ $oldLanguage == 'bm' ? 'selected' : '' }} value="bm">Bambara (bm)</option>
                <option {{ $oldLanguage == 'ba' ? 'selected' : '' }} value="ba">Bashkir (ba)</option>
                <option {{ $oldLanguage == 'eu' ? 'selected' : '' }} value="eu">Basque (eu)</option>
                <option {{ $oldLanguage == 'be' ? 'selected' : '' }} value="be">Belarusian (be)</option>
                <option {{ $oldLanguage == 'bn' ? 'selected' : '' }} value="bn">Bengali (bn)</option>
                <option {{ $oldLanguage == 'bi' ? 'selected' : '' }} value="bi">Bislama (bi)</option>
                <option {{ $oldLanguage == 'bs' ? 'selected' : '' }} value="bs">Bosnian (bs)</option>
                <option {{ $oldLanguage == 'br' ? 'selected' : '' }} value="br">Breton (br)</option>
                <option {{ $oldLanguage == 'bg' ? 'selected' : '' }} value="bg">Bulgarian (bg)</option>
                <option {{ $oldLanguage == 'my' ? 'selected' : '' }} value="my">Burmese (my)</option>
                <option {{ $oldLanguage == 'ca' ? 'selected' : '' }} value="ca">Catalan, Valencian (ca)</option>
                <option {{ $oldLanguage == 'ch' ? 'selected' : '' }} value="ch">Chamorro (ch)</option>
                <option {{ $oldLanguage == 'ce' ? 'selected' : '' }} value="ce">Chechen (ce)</option>
                <option {{ $oldLanguage == 'ny' ? 'selected' : '' }} value="ny">Chichewa, Chewa, Nyanja (ny)</option>
                <option {{ $oldLanguage == 'zh' ? 'selected' : '' }} value="zh">Chinese (zh)</option>
                <option {{ $oldLanguage == 'cu' ? 'selected' : '' }} value="cu">Church Slavic, Old Slavonic, Church
                    Slavonic, Old Bulgarian, Old Church Slavonic (cu)
                </option>
                <option {{ $oldLanguage == 'cv' ? 'selected' : '' }} value="cv">Chuvash (cv)</option>
                <option {{ $oldLanguage == 'kw' ? 'selected' : '' }} value="kw">Cornish (kw)</option>
                <option {{ $oldLanguage == 'co' ? 'selected' : '' }} value="co">Corsican (co)</option>
                <option {{ $oldLanguage == 'cr' ? 'selected' : '' }} value="cr">Cree (cr)</option>
                <option {{ $oldLanguage == 'hr' ? 'selected' : '' }} value="hr">Croatian (hr)</option>
                <option {{ $oldLanguage == 'cs' ? 'selected' : '' }} value="cs">Czech (cs)</option>
                <option {{ $oldLanguage == 'da' ? 'selected' : '' }} value="da">Danish (da)</option>
                <option {{ $oldLanguage == 'dv' ? 'selected' : '' }} value="dv">Divehi, Dhivehi, Maldivian (dv)</option>
                <option {{ $oldLanguage == 'nl' ? 'selected' : '' }} value="nl">Dutch, Flemish (nl)</option>
                <option {{ $oldLanguage == 'dz' ? 'selected' : '' }} value="dz">Dzongkha (dz)</option>
                <option {{ $oldLanguage == 'en' ? 'selected' : '' }} value="en">English (en)</option>
                <option {{ $oldLanguage == 'eo' ? 'selected' : '' }} value="eo">Esperanto (eo)</option>
                <option {{ $oldLanguage == 'et' ? 'selected' : '' }} value="et">Estonian (et)</option>
                <option {{ $oldLanguage == 'ee' ? 'selected' : '' }} value="ee">Ewe (ee)</option>
                <option {{ $oldLanguage == 'fo' ? 'selected' : '' }} value="fo">Faroese (fo)</option>
                <option {{ $oldLanguage == 'fj' ? 'selected' : '' }} value="fj">Fijian (fj)</option>
                <option {{ $oldLanguage == 'fi' ? 'selected' : '' }} value="fi">Finnish (fi)</option>
                <option {{ $oldLanguage == 'fr' ? 'selected' : '' }} value="fr">French (fr)</option>
                <option {{ $oldLanguage == 'fy' ? 'selected' : '' }} value="fy">Western Frisian (fy)</option>
                <option {{ $oldLanguage == 'ff' ? 'selected' : '' }} value="ff">Fulah (ff)</option>
                <option {{ $oldLanguage == 'gd' ? 'selected' : '' }} value="gd">Gaelic, Scottish Gaelic (gd)</option>
                <option {{ $oldLanguage == 'gl' ? 'selected' : '' }} value="gl">Galician (gl)</option>
                <option {{ $oldLanguage == 'lg' ? 'selected' : '' }} value="lg">Ganda (lg)</option>
                <option {{ $oldLanguage == 'ka' ? 'selected' : '' }} value="ka">Georgian (ka)</option>
                <option {{ $oldLanguage == 'de' ? 'selected' : '' }} value="de">German (de)</option>
                <option {{ $oldLanguage == 'el' ? 'selected' : '' }} value="el">Greek, Modern (1453–) (el)</option>
                <option {{ $oldLanguage == 'kl' ? 'selected' : '' }} value="kl">Kalaallisut, Greenlandic (kl)</option>
                <option {{ $oldLanguage == 'gn' ? 'selected' : '' }} value="gn">Guarani (gn)</option>
                <option {{ $oldLanguage == 'gu' ? 'selected' : '' }} value="gu">Gujarati (gu)</option>
                <option {{ $oldLanguage == 'ht' ? 'selected' : '' }} value="ht">Haitian, Haitian Creole (ht)</option>
                <option {{ $oldLanguage == 'ha' ? 'selected' : '' }} value="ha">Hausa (ha)</option>
                <option {{ $oldLanguage == 'he' ? 'selected' : '' }} value="he">Hebrew (he)</option>
                <option {{ $oldLanguage == 'hz' ? 'selected' : '' }} value="hz">Herero (hz)</option>
                <option {{ $oldLanguage == 'hi' ? 'selected' : '' }} value="hi">Hindi (hi)</option>
                <option {{ $oldLanguage == 'ho' ? 'selected' : '' }} value="ho">Hiri Motu (ho)</option>
                <option {{ $oldLanguage == 'hu' ? 'selected' : '' }} value="hu">Hungarian (hu)</option>
                <option {{ $oldLanguage == 'is' ? 'selected' : '' }} value="is">Icelandic (is)</option>
                <option {{ $oldLanguage == 'io' ? 'selected' : '' }} value="io">Ido (io)</option>
                <option {{ $oldLanguage == 'ig' ? 'selected' : '' }} value="ig">Igbo (ig)</option>
                <option {{ $oldLanguage == 'id' ? 'selected' : '' }} value="id">Indonesian (id)</option>
                <option {{ $oldLanguage == 'ia' ? 'selected' : '' }} value="ia">Interlingua (International Auxiliary
                    Language Association) (ia)
                </option>
                <option {{ $oldLanguage == 'ie' ? 'selected' : '' }} value="ie">Interlingue, Occidental (ie)</option>
                <option {{ $oldLanguage == 'iu' ? 'selected' : '' }} value="iu">Inuktitut (iu)</option>
                <option {{ $oldLanguage == 'ik' ? 'selected' : '' }} value="ik">Inupiaq (ik)</option>
                <option {{ $oldLanguage == 'ga' ? 'selected' : '' }} value="ga">Irish (ga)</option>
                <option {{ $oldLanguage == 'it' ? 'selected' : '' }} value="it">Italian (it)</option>
                <option {{ $oldLanguage == 'ja' ? 'selected' : '' }} value="ja">Japanese (ja)</option>
                <option {{ $oldLanguage == 'jv' ? 'selected' : '' }} value="jv">Javanese (jv)</option>
                <option {{ $oldLanguage == 'kn' ? 'selected' : '' }} value="kn">Kannada (kn)</option>
                <option {{ $oldLanguage == 'kr' ? 'selected' : '' }} value="kr">Kanuri (kr)</option>
                <option {{ $oldLanguage == 'ks' ? 'selected' : '' }} value="ks">Kashmiri (ks)</option>
                <option {{ $oldLanguage == 'kk' ? 'selected' : '' }} value="kk">Kazakh (kk)</option>
                <option {{ $oldLanguage == 'km' ? 'selected' : '' }} value="km">Central Khmer (km)</option>
                <option {{ $oldLanguage == 'ki' ? 'selected' : '' }} value="ki">Kikuyu, Gikuyu (ki)</option>
                <option {{ $oldLanguage == 'rw' ? 'selected' : '' }} value="rw">Kinyarwanda (rw)</option>
                <option {{ $oldLanguage == 'ky' ? 'selected' : '' }} value="ky">Kirghiz, Kyrgyz (ky)</option>
                <option {{ $oldLanguage == 'kv' ? 'selected' : '' }} value="kv">Komi (kv)</option>
                <option {{ $oldLanguage == 'kg' ? 'selected' : '' }} value="kg">Kongo (kg)</option>
                <option {{ $oldLanguage == 'ko' ? 'selected' : '' }} value="ko">Korean (ko)</option>
                <option {{ $oldLanguage == 'kj' ? 'selected' : '' }} value="kj">Kuanyama, Kwanyama (kj)</option>
                <option {{ $oldLanguage == 'ku' ? 'selected' : '' }} value="ku">Kurdish (ku)</option>
                <option {{ $oldLanguage == 'lo' ? 'selected' : '' }} value="lo">Lao (lo)</option>
                <option {{ $oldLanguage == 'la' ? 'selected' : '' }} value="la">Latin (la)</option>
                <option {{ $oldLanguage == 'lv' ? 'selected' : '' }} value="lv">Latvian (lv)</option>
                <option {{ $oldLanguage == 'li' ? 'selected' : '' }} value="li">Limburgan, Limburger, Limburgish (li)
                </option>
                <option {{ $oldLanguage == 'ln' ? 'selected' : '' }} value="ln">Lingala (ln)</option>
                <option {{ $oldLanguage == 'lt' ? 'selected' : '' }} value="lt">Lithuanian (lt)</option>
                <option {{ $oldLanguage == 'lu' ? 'selected' : '' }} value="lu">Luba-Katanga (lu)</option>
                <option {{ $oldLanguage == 'lb' ? 'selected' : '' }} value="lb">Luxembourgish, Letzeburgesch (lb)
                </option>
                <option {{ $oldLanguage == 'mk' ? 'selected' : '' }} value="mk">Macedonian (mk)</option>
                <option {{ $oldLanguage == 'mg' ? 'selected' : '' }} value="mg">Malagasy (mg)</option>
                <option {{ $oldLanguage == 'ms' ? 'selected' : '' }} value="ms">Malay (ms)</option>
                <option {{ $oldLanguage == 'ml' ? 'selected' : '' }} value="ml">Malayalam (ml)</option>
                <option {{ $oldLanguage == 'mt' ? 'selected' : '' }} value="mt">Maltese (mt)</option>
                <option {{ $oldLanguage == 'gv' ? 'selected' : '' }} value="gv">Manx (gv)</option>
                <option {{ $oldLanguage == 'mi' ? 'selected' : '' }} value="mi">Maori (mi)</option>
                <option {{ $oldLanguage == 'mr' ? 'selected' : '' }} value="mr">Marathi (mr)</option>
                <option {{ $oldLanguage == 'mh' ? 'selected' : '' }} value="mh">Marshallese (mh)</option>
                <option {{ $oldLanguage == 'mn' ? 'selected' : '' }} value="mn">Mongolian (mn)</option>
                <option {{ $oldLanguage == 'na' ? 'selected' : '' }} value="na">Nauru (na)</option>
                <option {{ $oldLanguage == 'nv' ? 'selected' : '' }} value="nv">Navajo, Navaho (nv)</option>
                <option {{ $oldLanguage == 'nd' ? 'selected' : '' }} value="nd">North Ndebele (nd)</option>
                <option {{ $oldLanguage == 'nr' ? 'selected' : '' }} value="nr">South Ndebele (nr)</option>
                <option {{ $oldLanguage == 'ng' ? 'selected' : '' }} value="ng">Ndonga (ng)</option>
                <option {{ $oldLanguage == 'ne' ? 'selected' : '' }} value="ne">Nepali (ne)</option>
                <option {{ $oldLanguage == 'no' ? 'selected' : '' }} value="no">Norwegian (no)</option>
                <option {{ $oldLanguage == 'nb' ? 'selected' : '' }} value="nb">Norwegian Bokmål (nb)</option>
                <option {{ $oldLanguage == 'nn' ? 'selected' : '' }} value="nn">Norwegian Nynorsk (nn)</option>
                <option {{ $oldLanguage == 'ii' ? 'selected' : '' }} value="ii">Sichuan Yi, Nuosu (ii)</option>
                <option {{ $oldLanguage == 'oc' ? 'selected' : '' }} value="oc">Occitan (oc)</option>
                <option {{ $oldLanguage == 'oj' ? 'selected' : '' }} value="oj">Ojibwa (oj)</option>
                <option {{ $oldLanguage == 'or' ? 'selected' : '' }} value="or">Oriya (or)</option>
                <option {{ $oldLanguage == 'om' ? 'selected' : '' }} value="om">Oromo (om)</option>
                <option {{ $oldLanguage == 'os' ? 'selected' : '' }} value="os">Ossetian, Ossetic (os)</option>
                <option {{ $oldLanguage == 'pi' ? 'selected' : '' }} value="pi">Pali (pi)</option>
                <option {{ $oldLanguage == 'ps' ? 'selected' : '' }} value="ps">Pashto, Pushto (ps)</option>
                <option {{ $oldLanguage == 'fa' ? 'selected' : '' }} value="fa">Persian (fa)</option>
                <option {{ $oldLanguage == 'pl' ? 'selected' : '' }} value="pl">Polish (pl)</option>
                <option {{ $oldLanguage == 'pt' ? 'selected' : '' }} value="pt">Portuguese (pt)</option>
                <option {{ $oldLanguage == 'pa' ? 'selected' : '' }} value="pa">Punjabi, Panjabi (pa)</option>
                <option {{ $oldLanguage == 'qu' ? 'selected' : '' }} value="qu">Quechua (qu)</option>
                <option {{ $oldLanguage == 'ro' ? 'selected' : '' }} value="ro">Romanian, Moldavian, Moldovan (ro)
                </option>
                <option {{ $oldLanguage == 'rm' ? 'selected' : '' }} value="rm">Romansh (rm)</option>
                <option {{ $oldLanguage == 'rn' ? 'selected' : '' }} value="rn">Rundi (rn)</option>
                <option {{ $oldLanguage == 'ru' ? 'selected' : '' }} value="ru">Russian (ru)</option>
                <option {{ $oldLanguage == 'se' ? 'selected' : '' }} value="se">Northern Sami (se)</option>
                <option {{ $oldLanguage == 'sm' ? 'selected' : '' }} value="sm">Samoan (sm)</option>
                <option {{ $oldLanguage == 'sg' ? 'selected' : '' }} value="sg">Sango (sg)</option>
                <option {{ $oldLanguage == 'sa' ? 'selected' : '' }} value="sa">Sanskrit (sa)</option>
                <option {{ $oldLanguage == 'sc' ? 'selected' : '' }} value="sc">Sardinian (sc)</option>
                <option {{ $oldLanguage == 'sr' ? 'selected' : '' }} value="sr">Serbian (sr)</option>
                <option {{ $oldLanguage == 'sn' ? 'selected' : '' }} value="sn">Shona (sn)</option>
                <option {{ $oldLanguage == 'sd' ? 'selected' : '' }} value="sd">Sindhi (sd)</option>
                <option {{ $oldLanguage == 'si' ? 'selected' : '' }} value="si">Sinhala, Sinhalese (si)</option>
                <option {{ $oldLanguage == 'sk' ? 'selected' : '' }} value="sk">Slovak (sk)</option>
                <option {{ $oldLanguage == 'sl' ? 'selected' : '' }} value="sl">Slovenian (sl)</option>
                <option {{ $oldLanguage == 'so' ? 'selected' : '' }} value="so">Somali (so)</option>
                <option {{ $oldLanguage == 'st' ? 'selected' : '' }} value="st">Southern Sotho (st)</option>
                <option {{ $oldLanguage == 'es' ? 'selected' : '' }} value="es">Spanish, Castilian (es)</option>
                <option {{ $oldLanguage == 'su' ? 'selected' : '' }} value="su">Sundanese (su)</option>
                <option {{ $oldLanguage == 'sw' ? 'selected' : '' }} value="sw">Swahili (sw)</option>
                <option {{ $oldLanguage == 'ss' ? 'selected' : '' }} value="ss">Swati (ss)</option>
                <option {{ $oldLanguage == 'sv' ? 'selected' : '' }} value="sv">Swedish (sv)</option>
                <option {{ $oldLanguage == 'tl' ? 'selected' : '' }} value="tl">Tagalog (tl)</option>
                <option {{ $oldLanguage == 'ty' ? 'selected' : '' }} value="ty">Tahitian (ty)</option>
                <option {{ $oldLanguage == 'tg' ? 'selected' : '' }} value="tg">Tajik (tg)</option>
                <option {{ $oldLanguage == 'ta' ? 'selected' : '' }} value="ta">Tamil (ta)</option>
                <option {{ $oldLanguage == 'tt' ? 'selected' : '' }} value="tt">Tatar (tt)</option>
                <option {{ $oldLanguage == 'te' ? 'selected' : '' }} value="te">Telugu (te)</option>
                <option {{ $oldLanguage == 'th' ? 'selected' : '' }} value="th">Thai (th)</option>
                <option {{ $oldLanguage == 'bo' ? 'selected' : '' }} value="bo">Tibetan (bo)</option>
                <option {{ $oldLanguage == 'ti' ? 'selected' : '' }} value="ti">Tigrinya (ti)</option>
                <option {{ $oldLanguage == 'to' ? 'selected' : '' }} value="to">Tonga (Tonga Islands) (to)</option>
                <option {{ $oldLanguage == 'ts' ? 'selected' : '' }} value="ts">Tsonga (ts)</option>
                <option {{ $oldLanguage == 'tn' ? 'selected' : '' }} value="tn">Tswana (tn)</option>
                <option {{ $oldLanguage == 'tr' ? 'selected' : '' }} value="tr">Turkish (tr)</option>
                <option {{ $oldLanguage == 'tk' ? 'selected' : '' }} value="tk">Turkmen (tk)</option>
                <option {{ $oldLanguage == 'tw' ? 'selected' : '' }} value="tw">Twi (tw)</option>
                <option {{ $oldLanguage == 'ug' ? 'selected' : '' }} value="ug">Uighur, Uyghur (ug)</option>
                <option {{ $oldLanguage == 'uk' ? 'selected' : '' }} value="uk">Ukrainian (uk)</option>
                <option {{ $oldLanguage == 'ur' ? 'selected' : '' }} value="ur">Urdu (ur)</option>
                <option {{ $oldLanguage == 'uz' ? 'selected' : '' }} value="uz">Uzbek (uz)</option>
                <option {{ $oldLanguage == 've' ? 'selected' : '' }} value="ve">Venda (ve)</option>
                <option {{ $oldLanguage == 'vi' ? 'selected' : '' }} value="vi">Vietnamese (vi)</option>
                <option {{ $oldLanguage == 'vo' ? 'selected' : '' }} value="vo">Volapük (vo)</option>
                <option {{ $oldLanguage == 'wa' ? 'selected' : '' }} value="wa">Walloon (wa)</option>
                <option {{ $oldLanguage == 'cy' ? 'selected' : '' }} value="cy">Welsh (cy)</option>
                <option {{ $oldLanguage == 'wo' ? 'selected' : '' }} value="wo">Wolof (wo)</option>
                <option {{ $oldLanguage == 'xh' ? 'selected' : '' }} value="xh">Xhosa (xh)</option>
                <option {{ $oldLanguage == 'yi' ? 'selected' : '' }} value="yi">Yiddish (yi)</option>
                <option {{ $oldLanguage == 'yo' ? 'selected' : '' }} value="yo">Yoruba (yo)</option>
                <option {{ $oldLanguage == 'za' ? 'selected' : '' }} value="za">Zhuang, Chuang (za)</option>
                <option {{ $oldLanguage == 'zu' ? 'selected' : '' }} value="zu">Zulu (zu)</option>

            </select>
            <label for="language_code">Language code</label>
            <div class="invalid-feedback">
                Please choose a language.
            </div>
        </div>
        <div class="form-floating mb-3">
            <input type="text"
                   class="form-control @error('isbn') is-invalid @enderror"
                   id="isbn"
                   name="isbn"
                   placeholder="ISBN..."
                   maxlength="13"
                   value="{{ old('isbn', $book?->isbn ?? '') }}">

            <label for="isbn">ISBN</label>
            <div class="invalid-feedback">
                Please enter a valid ISBN number. <a
                    href="https://en.wikipedia.org/wiki/International_Standard_Book_Number">more info here</a>.
            </div>
        </div>
        <div class="form-floating mb-3">
            <input
                type="number"
                class="form-control @error('in_stock') is-invalid @enderror"
                value="{{ old('in_stock', $book?->in_stock ?? '1') }}"
                id="in_stock"
                name="in_stock"
                placeholder="In stock...">
            <label for="in_stock">Stock size</label>
            <div class="invalid-feedback">
                Please enter a stock size, it must be greater than 1.
            </div>
        </div>

        @error('genres')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror

        <ul class="list-group mb-3">
            @foreach($genres as $genre)
                <li class="list-group-item">
                    <div class="ms-3">
                        <input
                            id="checkbox-genre-{{$genre->id}}"
                            class="form-check-input me-1"
                            type="checkbox"
                            name="genres[]"
                            value="{{$genre->id}}"
                            {{ in_array($genre->id, old('genres', [])) || ( $book->genres->contains($genre)) != null ? "checked" : "" }}>
                        <label class="m-0" for="checkbox-genre-{{$genre->id}}">{{ $genre->name }}</label>
                    </div>
                </li>
            @endforeach
        </ul>


        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-lg btn-primary">Submit</button>
        </div>
    </form>
@endsection
