<template>
    <div>
        <h1 class="page-title text-3xl font-bold px-5 pt-5">CPR</h1>


        <div class="cpr-page">

            <div class="container px-5">

                <div class="cpr-wrapper">
                    <div class="cpr-box">

                        <div v-if="!views.result"  class="mt-4 mb-6 p-5 bg-gray-200 rounded text-sm">
                            De gewenste CPR voor uw kabel bepalen.
                        </div>

                        <form v-if="!views.result" class="section-calculation">
                                <div class="block text-sm font-medium text-gray-700 mt-3"><span class="theme-color">1.</span> Gebruiksfunctie</div>
                                <div class="section section-1">
                                    <div class="selection-row">
                                        <select v-model="form.gebruiksfunctie" name="gebruiksfunctie" class="shadow-md mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="" selected disabled>Selecteer een gebruiksfunctie</option>
                                            <option value="1a">Woonfunctie, in een wooongebouw</option>
                                            <option value="1b">Woonfunctie, g.o. > 500 m2</option>
                                            <option value="1c">Andere woonfunctie</option>
                                            <option value="2a">Bijeenkomstfunctie, kinderen <4 jaar</option>
                                            <option value="2b">Andere bijeenkomstfunctie</option>
                                            <option value="3a">Celfunctie</option>
                                            <option value="4a">Gezondheidszorg met bedgebied</option>
                                            <option value="4b">Met andere Gezondheidszorgfunctie</option>
                                            <option value="5a">Lichte industrie, dieren</option>
                                            <option value="5b">Andere Industriefunctie</option>
                                            <option value="6a">Kantoorfunctie</option>
                                            <option value="7a">Logiesfunctie</option>
                                            <option value="8a">Onderwijsfunctie</option>
                                            <option value="9a">Sportfunctie</option>
                                            <option value="10a">Winkelfunctie</option>
                                            <option value="11a">Overige gebruiksfunctie</option>
                                            <option value="12a">Tunnel</option>
                                            <option value="12b">Ander bouwwerk geen gebouw zijnde</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="block text-sm font-medium text-gray-700 mt-3"><span class="theme-color">2.</span> Grenswaarden</div>
                                <div class="section section-2">
                                    <div class="selection-row">
                                        <select v-model="form.grenswaarden" name="grenswaarden" class="shadow-md mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="" selected disabled>Selecteer de grenswaarden</option>
                                            <option value="g1">binnen, extra beschermende vluchtr</option>
                                            <option value="g2">binnenlucht, beschermende vluchtr</option>
                                            <option value="g3">binnenlucht, overig</option>
                                            <option value="g4">buitenlucht, extra beschermde vluchtr</option>
                                            <option value="g5">buitenlucht, beschermde vluchtr</option>
                                            <option value="g6">Buitenlucht, overig</option>
                                            <option value="g7">Bovenzijde, extra bescherm.vluchtr</option>
                                            <option value="g8">Bovenzijde, beschermende vluchtr</option>
                                            <option value="g9">Bovenzijde, overig</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="block text-sm font-medium text-gray-700 mt-3"><span class="theme-color">3.</span> Vrijgesteld</div>
                                <div class="section section-3">
                                    <div class="selection-row">
                                        <select v-model="form.vrijgesteld" name="vrijgesteld" class="shadow-md mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="" selected disabled>Selecteer vrijgesteld</option>
                                            <option value="minderdan5">Oppervlak < 5%</option>
                                            <option value="minderdan10">Oppervlak < 10%</option>
                                            <option value="meerdan10">Oppervlak > 10%</option>
                                            <option value="indegrond">In de grond</option>
                                            <option value="functiebehoud">Heeft functiebehoud</option>
                                            <option value="vastekonnektoren">Leiding met vaste connectoren</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="calculation-wrapper mt-5">
                                    <button @click="calculateCprButton" type="button"
                                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200">
                                        CPR Bepalen
                                    </button>
                                </div>
                            </form>

                        <transition name="slide-fade">
                            <div v-if="views.result" class="section-result mt-5 mb-">
                                <div class="p-5 mb-4 bg-blue-theme text-white text-center shadow-md font-medium text-2xl rounded-md">
                                    <p class="text-gray-100 text-sm">Brandklasse en rookklasse voor uw kabel</p>
                                    {{ result }}
                                </div>
                                <div class="back-to-calculation">
                                    <button @click="switchScreen('calculation')" type="button" class="inline-flex items-center px-5 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Terug
                                    </button>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "Cpr",
    data() {
        return {
            form: {
                gebruiksfunctie: null,
                grenswaarden: null,
                vrijgesteld: null
            },
            result: null,
            views: {
                result: false,
            }
        }
    },
    methods: {
        calculateCpr(valGrenswaarde, valVrijgesteld, valGebruiksfunctie) {
            let grenswaarde;

            let brandklasse = "E",
                rookklasse = "s3";

            let binnenlucht_extra = 0,
                binnenlucht_normaal = 1,
                binnenlucht_overig = 2,
                buitenlucht_extra = 3,
                buitenlucht_normaal = 4,
                buitenlucht_overig = 5,
                bovenzijde_extra = 6,
                bovenzijde_normaal = 7,
                bovenzijde_overig = 8;

            switch (valGrenswaarde) {
                case 'g1':
                    grenswaarde = binnenlucht_extra;
                    break;
                case 'g2':
                    grenswaarde = binnenlucht_normaal;
                    break;
                case 'g3':
                    grenswaarde = binnenlucht_overig;
                    break;
                case 'g4':
                    grenswaarde = buitenlucht_extra;
                    break;
                case 'g5':
                    grenswaarde = buitenlucht_normaal;
                    break;
                case 'g6':
                    grenswaarde = buitenlucht_overig;
                    break;
                case 'g7':
                    grenswaarde = bovenzijde_extra;
                    break;
                case 'g8':
                    grenswaarde = bovenzijde_normaal;
                    break;
                case 'g9':
                    grenswaarde = bovenzijde_overig;
                    break;
            }

            //Rookklasse binnenlucht: Artikel 2.67. Binnenoppervlak
            if (grenswaarde >= binnenlucht_extra && grenswaarde <= binnenlucht_overig) {
                if (grenswaarde >= binnenlucht_extra && grenswaarde <= binnenlucht_normaal) {
                    rookklasse = "s2";
                }
            }

            //rookklasse buitenlucht Artikel 2.68. Buitenoppervlak
            if (grenswaarde >= buitenlucht_extra && grenswaarde <= buitenlucht_overig) rookklasse = "s3";

            //Rookklasse elektrische leidingen: Artikel 2.69a.  Elektrische leidingen en pijpisolatie
            if (grenswaarde >= binnenlucht_extra && grenswaarde <= binnenlucht_overig) {
                //afwijking op 2.67
                // lid 1
                rookklasse = "s2";
                if (grenswaarde === binnenlucht_extra) rookklasse = 's1';
            }

            switch (valVrijgesteld) {
                case 'minderdan5':
                    rookklasse = "s3";
                    brandklasse = "E";
                    break;
                case 'minderdan10':
                    if (grenswaarde === binnenlucht_overig || grenswaarde === buitenlucht_overig || grenswaarde === bovenzijde_overig) {
                        if (rookklasse === 's2') {
                            if (grenswaarde >= binnenlucht_extra && grenswaarde <= binnenlucht_overig) {
                                rookklasse = "s3";
                                brandklasse = "E";
                            }
                        }
                    }
                    break;
                case 'indegrond':
                    rookklasse = "s3";
                    brandklasse = "F";
                    break;
                case 'functiebehoud':
                    rookklasse = "s3";
                    brandklasse = "nvt";
                    break;
                case 'vastekonnektoren':
                    rookklasse = "s3";
                    brandklasse = "nvt";
                    break;
                default:
                    switch (valGebruiksfunctie) {
                        case '1a':
                            switch (valGrenswaarde) {
                                case 'g1':
                                    brandklasse = "B";
                                    break;
                                case 'g2':
                                    brandklasse = "B";
                                    break;
                                case 'g3':
                                    brandklasse = "D";
                                    break;
                                case 'g4':
                                    brandklasse = "B";
                                    break;
                                case 'g5':
                                    brandklasse = "C";
                                    break;
                                case 'g6':
                                    brandklasse = "D";
                                    break;
                                case 'g7':
                                    brandklasse = "C";
                                    break;
                                case 'g8':
                                    brandklasse = "C";
                                    break;
                                case 'g9':
                                    brandklasse = "D";
                                    break;
                            }
                            break;
                        case '1b':
                            switch (valGrenswaarde) {
                                case 'g1':
                                    brandklasse = "B";
                                    break;
                                case 'g2':
                                    brandklasse = "B";
                                    break;
                                case 'g3':
                                    brandklasse = "D";
                                    break;
                                case 'g4':
                                    brandklasse = "B";
                                    break;
                                case 'g5':
                                    brandklasse = "B";
                                    break;
                                case 'g6':
                                    brandklasse = "D";
                                    break;
                                case 'g7':
                                    brandklasse = "C";
                                    break;
                                case 'g8':
                                    brandklasse = "C";
                                    break;
                                case 'g9':
                                    brandklasse = "D";
                                    break;
                            }
                            break;
                        case '1c':
                            switch (valGrenswaarde) {
                                case 'g1':
                                    brandklasse = "B";
                                    break;
                                case 'g2':
                                    brandklasse = "D";
                                    break;
                                case 'g3':
                                    brandklasse = "D";
                                    break;
                                case 'g4':
                                    brandklasse = "B";
                                    break;
                                case 'g5':
                                    brandklasse = "D";
                                    break;
                                case 'g6':
                                    brandklasse = "D";
                                    break;
                                case 'g7':
                                    brandklasse = "C";
                                    break;
                                case 'g8':
                                    brandklasse = "D";
                                    break;
                                case 'g9':
                                    brandklasse = "D";
                                    break;
                            }
                            break;
                        case '2a':
                            switch (valGrenswaarde) {
                                case 'g1':
                                    brandklasse = "B";
                                    break;
                                case 'g2':
                                    brandklasse = "B";
                                    break;
                                case 'g3':
                                    brandklasse = "D";
                                    break;
                                case 'g4':
                                    brandklasse = "B";
                                    break;
                                case 'g5':
                                    brandklasse = "B";
                                    break;
                                case 'g6':
                                    brandklasse = "D";
                                    break;
                                case 'g7':
                                    brandklasse = "C";
                                    break;
                                case 'g8':
                                    brandklasse = "D";
                                    break;
                                case 'g9':
                                    brandklasse = "D";
                                    break;
                            }
                            break;
                        case '2b':
                            switch (valGrenswaarde) {
                                case 'g1':
                                    brandklasse = "B";
                                    break;
                                case 'g2':
                                    brandklasse = "D";
                                    break;
                                case 'g3':
                                    brandklasse = "D";
                                    break;
                                case 'g4':
                                    brandklasse = "B";
                                    break;
                                case 'g5':
                                    brandklasse = "D";
                                    break;
                                case 'g6':
                                    brandklasse = "D";
                                    break;
                                case 'g7':
                                    brandklasse = "C";
                                    break;
                                case 'g8':
                                    brandklasse = "D";
                                    break;
                                case 'g9':
                                    brandklasse = "D";
                                    break;
                            }
                            break;
                        case '3a':
                            switch (valGrenswaarde) {
                                case 'g1':
                                    brandklasse = "B";
                                    break;
                                case 'g2':
                                    brandklasse = "B";
                                    break;
                                case 'g3':
                                    brandklasse = "C";
                                    break;
                                case 'g4':
                                    brandklasse = "B";
                                    break;
                                case 'g5':
                                    brandklasse = "B";
                                    break;
                                case 'g6':
                                    brandklasse = "D";
                                    break;
                                case 'g7':
                                    brandklasse = "C";
                                    break;
                                case 'g8':
                                    brandklasse = "C";
                                    break;
                                case 'g9':
                                    brandklasse = "C";
                                    break;
                            }
                            break;
                        case '4a':
                            switch (valGrenswaarde) {
                                case 'g1':
                                    brandklasse = "B";
                                    break;
                                case 'g2':
                                    brandklasse = "B";
                                    break;
                                case 'g3':
                                    brandklasse = "D";
                                    break;
                                case 'g4':
                                    brandklasse = "B";
                                    break;
                                case 'g5':
                                    brandklasse = "B";
                                    break;
                                case 'g6':
                                    brandklasse = "D";
                                    break;
                                case 'g7':
                                    brandklasse = "C";
                                    break;
                                case 'g8':
                                    brandklasse = "D";
                                    break;
                                case 'g9':
                                    brandklasse = "D";
                                    break;
                            }
                            break;
                        case '4b':
                            switch (valGrenswaarde) {
                                case 'g1':
                                    brandklasse = "B";
                                    break;
                                case 'g2':
                                    brandklasse = "D";
                                    break;
                                case 'g3':
                                    brandklasse = "D";
                                    break;
                                case 'g4':
                                    brandklasse = "B";
                                    break;
                                case 'g5':
                                    brandklasse = "D";
                                    break;
                                case 'g6':
                                    brandklasse = "D";
                                    break;
                                case 'g7':
                                    brandklasse = "C";
                                    break;
                                case 'g8':
                                    brandklasse = "D";
                                    break;
                                case 'g9':
                                    brandklasse = "D";
                                    break;
                            }
                            break;
                        case '5a':
                            switch (valGrenswaarde) {
                                case 'g1':
                                    brandklasse = "B";
                                    break;
                                case 'g2':
                                    brandklasse = "B";
                                    break;
                                case 'g3':
                                    brandklasse = "B";
                                    break;
                                case 'g4':
                                    brandklasse = "B";
                                    break;
                                case 'g5':
                                    brandklasse = "D";
                                    break;
                                case 'g6':
                                    brandklasse = "D";
                                    break;
                                case 'g7':
                                    brandklasse = "C";
                                    break;
                                case 'g8':
                                    brandklasse = "D";
                                    break;
                                case 'g9':
                                    brandklasse = "D";
                                    break;
                            }
                            break;
                        case '5b':
                            switch (valGrenswaarde) {
                                case 'g1':
                                    brandklasse = "B";
                                    break;
                                case 'g2':
                                    brandklasse = "D";
                                    break;
                                case 'g3':
                                    brandklasse = "D";
                                    break;
                                case 'g4':
                                    brandklasse = "B";
                                    break;
                                case 'g5':
                                    brandklasse = "D";
                                    break;
                                case 'g6':
                                    brandklasse = "D";
                                    break;
                                case 'g7':
                                    brandklasse = "C";
                                    break;
                                case 'g8':
                                    brandklasse = "D";
                                    break;
                                case 'g9':
                                    brandklasse = "D";
                                    break;
                            }
                            break;
                        case '6a':
                            switch (valGrenswaarde) {
                                case 'g1':
                                    brandklasse = "B";
                                    break;
                                case 'g2':
                                    brandklasse = "D";
                                    break;
                                case 'g3':
                                    brandklasse = "D";
                                    break;
                                case 'g4':
                                    brandklasse = "B";
                                    break;
                                case 'g5':
                                    brandklasse = "D";
                                    break;
                                case 'g6':
                                    brandklasse = "D";
                                    break;
                                case 'g7':
                                    brandklasse = "C";
                                    break;
                                case 'g8':
                                    brandklasse = "D";
                                    break;
                                case 'g9':
                                    brandklasse = "D";
                                    break;
                            }
                            break;
                        case '7a':
                            switch (valGrenswaarde) {
                                case 'g1':
                                    brandklasse = "B";
                                    break;
                                case 'g2':
                                    brandklasse = "B";
                                    break;
                                case 'g3':
                                    brandklasse = "D";
                                    break;
                                case 'g4':
                                    brandklasse = "B";
                                    break;
                                case 'g5':
                                    brandklasse = "B";
                                    break;
                                case 'g6':
                                    brandklasse = "D";
                                    break;
                                case 'g7':
                                    brandklasse = "C";
                                    break;
                                case 'g8':
                                    brandklasse = "D";
                                    break;
                                case 'g9':
                                    brandklasse = "D";
                                    break;
                            }
                            break;
                        case '8a':
                            switch (valGrenswaarde) {
                                case 'g1':
                                    brandklasse = "B";
                                    break;
                                case 'g2':
                                    brandklasse = "D";
                                    break;
                                case 'g3':
                                    brandklasse = "D";
                                    break;
                                case 'g4':
                                    brandklasse = "B";
                                    break;
                                case 'g5':
                                    brandklasse = "D";
                                    break;
                                case 'g6':
                                    brandklasse = "D";
                                    break;
                                case 'g7':
                                    brandklasse = "C";
                                    break;
                                case 'g8':
                                    brandklasse = "D";
                                    break;
                                case 'g9':
                                    brandklasse = "D";
                                    break;
                            }
                            break;
                        case '9a':
                            switch (valGrenswaarde) {
                                case 'g1':
                                    brandklasse = "B";
                                    break;
                                case 'g2':
                                    brandklasse = "D";
                                    break;
                                case 'g3':
                                    brandklasse = "D";
                                    break;
                                case 'g4':
                                    brandklasse = "B";
                                    break;
                                case 'g5':
                                    brandklasse = "D";
                                    break;
                                case 'g6':
                                    brandklasse = "D";
                                    break;
                                case 'g7':
                                    brandklasse = "C";
                                    break;
                                case 'g8':
                                    brandklasse = "D";
                                    break;
                                case 'g9':
                                    brandklasse = "D";
                                    break;
                            }
                            break;
                        case '10a':
                            switch (valGrenswaarde) {
                                case 'g1':
                                    brandklasse = "B";
                                    break;
                                case 'g2':
                                    brandklasse = "D";
                                    break;
                                case 'g3':
                                    brandklasse = "D";
                                    break;
                                case 'g4':
                                    brandklasse = "B";
                                    break;
                                case 'g5':
                                    brandklasse = "D";
                                    break;
                                case 'g6':
                                    brandklasse = "D";
                                    break;
                                case 'g7':
                                    brandklasse = "C";
                                    break;
                                case 'g8':
                                    brandklasse = "D";
                                    break;
                                case 'g9':
                                    brandklasse = "D";
                                    break;
                            }
                            break;
                        case '11a':
                            switch (valGrenswaarde) {
                                case 'g1':
                                    brandklasse = "B";
                                    break;
                                case 'g2':
                                    brandklasse = "D";
                                    break;
                                case 'g3':
                                    brandklasse = "D";
                                    break;
                                case 'g4':
                                    brandklasse = "B";
                                    break;
                                case 'g5':
                                    brandklasse = "D";
                                    break;
                                case 'g6':
                                    brandklasse = "D";
                                    break;
                                case 'g7':
                                    brandklasse = "C";
                                    break;
                                case 'g8':
                                    brandklasse = "D";
                                    break;
                                case 'g9':
                                    brandklasse = "D";
                                    break;
                            }
                            break;
                        case '12a':
                            switch (valGrenswaarde) {
                                case 'g1':
                                    brandklasse = "B";
                                    break;
                                case 'g2':
                                    brandklasse = "B";
                                    break;
                                case 'g3':
                                    brandklasse = "B";
                                    break;
                                case 'g4':
                                    brandklasse = "B";
                                    break;
                                case 'g5':
                                    brandklasse = "D";
                                    break;
                                case 'g6':
                                    brandklasse = "D";
                                    break;
                                case 'g7':
                                    brandklasse = "C";
                                    break;
                                case 'g8':
                                    brandklasse = "D";
                                    break;
                                case 'g9':
                                    brandklasse = "D";
                                    break;
                            }
                            break;
                        case '12B':
                            switch (valGrenswaarde) {
                                case 'g1':
                                    brandklasse = "-";
                                    break;
                                case 'g2':
                                    brandklasse = "-";
                                    break;
                                case 'g3':
                                    brandklasse = "-";
                                    break;
                                case 'g4':
                                    brandklasse = "B";
                                    break;
                                case 'g5':
                                    brandklasse = "D";
                                    break;
                                case 'g6':
                                    brandklasse = "D";
                                    break;
                                case 'g7':
                                    brandklasse = "C";
                                    break;
                                case 'g8':
                                    brandklasse = "D";
                                    break;
                                case 'g9':
                                    brandklasse = "D";
                                    break;
                            }
                            break;
                    }
                    break;
            }


            let result;
            switch (brandklasse) {
                case 'B':
                    result = ['B2ca', rookklasse, 'd1', 'a1'];
                    break;
                case 'C':
                    result = ['Cca', rookklasse, 'd2', 'a1'];
                    break;
                case 'D':
                    result = ['Dca', rookklasse, 'd2', 'a3'];
                    break;
                case 'E':
                    result = ['Eca'];
                    break;
                case 'F':
                    result = ['Fca'];
                    break;
                case 'nvt':
                    result = ['Niet van toepassing.'];
                    break;
            }

            let printText;
            if (result.length >= 4) {
                printText = result[0] + ', ' + result[1] + ', ' + result[2] + ', ' + result[3];
            } else {
                printText = result[0];
            }

            this.result = printText;

            this.switchScreen();

            return result;
        },

        switchScreen() {
            this.views.result = !this.views.result;
        },

        calculateCprButton() {
            if (this.form.gebruiksfunctie && this.form.grenswaarden && this.form.vrijgesteld) {
                console.log('Result: ', this.calculateCpr(this.form.grenswaarden, this.form.vrijgesteld, this.form.gebruiksfunctie));
            }
        }
    }
}
</script>

<style scoped>

</style>
