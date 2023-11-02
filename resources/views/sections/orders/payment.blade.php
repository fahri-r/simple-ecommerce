@extends('layouts.auth')
@section('content')
    <div class="contain py-16">
        <div class="max-w-3xl mx-auto">
            <div class="flex gap-10">
                <button type="submit"
                    class="block w-full py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">pay the bill</button>
                <button type="submit"
                    class="block w-full py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">export to pdf</button>
            </div>
            <div class="lg:w-1/12 xl:w-1/4"></div>
            <div
                class="w-full bg-white lg:w-full xl:w-2/3 lg:mt-20 lg:mb-20 lg:shadow-xl xl:mt-02 xl:mb-20 xl:shadow-xl print:transform print:scale-90">
                <header
                    class="flex flex-col items-center px-8 pt-20 text-lg text-center bg-white border-t-8 border-green-700 md:block lg:block xl:block print:block md:items-start lg:items-start xl:items-start print:items-start md:text-left lg:text-left xl:text-left print:text-left print:pt-8 print:px-2 md:relative lg:relative xl:relative print:relative">

                    <div
                        class="flex flex-row mt-12 mb-2 ml-0 text-2xl font-bold md:text-3xl lg:text-4xl xl:text-4xl print:text-2xl lg:ml-12 xl:ml-12">
                        INVOICE
                        <div class="text-green-700">
                            <span class="mr-4 text-sm">■ </span> #
                        </div>
                        <span id="invoice_id" class="text-gray-500">0196023</span>
                    </div>
                    {{-- <div class="flex flex-col lg:ml-12 xl:ml-12 print:text-sm text-left">
                        <span>Issue date: 2020.09.06</span>
                        <span>Paid date: 2020.09.07</span>
                        <span>Due date: 2020.10.06</span>
                    </div> --}}
                    <div
                        class="px-8 py-2 mt-16 text-3xl font-bold text-green-700 border-4 border-green-700 border-dotted md:absolute md:right-0 md:top-0 md:mr-12 lg:absolute lg:right-0 lg:top-0 xl:absolute xl:right-0 xl:top-0 print:absolute print:right-0 print:top-0 lg:mr-20 xl:mr-20 print:mr-2 print:mt-8">
                        PAID</div>
                    <contract
                        class="flex flex-col m-12 text-center lg:m-12 md:flex-none md:text-left md:relative md:m-0 md:mt-16 lg:flex-none lg:text-left lg:relative xl:flex-none xl:text-left xl:relative print:flex-none print:text-left print:relative print:m-0 print:mt-6 print:text-sm">
                        <span class="font-extrabold md:hidden lg:hidden xl:hidden print:hidden">FROM</span>
                        <from class="flex flex-col text-left">
                            <span id="company-name" class="font-medium">BroHosting</span>
                            <span id="company-country"><span class="flag-icon flag-icon-us"></span> United States</span>
                            <div class="flex-row">
                                <span id="c-city">New York</span>,
                                <span id="c-postal">NY 10023</span>
                            </div>
                            <span id="company-address">98-2 W 67th St</span>
                            <span id="company-phone">+12124567777</span>
                            <span id="company-mail">info@brohosting.us</span>
                        </from>
                        <span class="mt-12 font-extrabold md:hidden lg:hidden xl:hidden print:hidden">TO</span>
                        <to
                            class="flex flex-col md:absolute md:right-0 md:text-right lg:absolute lg:right-0 lg:text-right print:absolute print:right-0 print:text-right">
                            <span id="person-name" class="font-medium">Cloud Solutions Inc</span>
                            <span id="person-country"><span class="flag-icon flag-icon-hu"></span> Hungary</span>
                            <div class="flex-row">
                                <span id="p-postal">3100</span>
                                <span id="p-city">Salgótarján</span>,
                            </div>
                            <span id="person-address">Rákóczi út 12.</span>
                            <span id="person-phone">+36300000000</span>
                            <span id="person-mail">info@cloudsolutions.hu</span>
                        </to>
                    </contract>
                </header>
                <hr class="border-gray-300 md:mt-8 print:hidden">
                <content>
                    <div id="content" class="flex justify-center md:p-8 lg:p-20 xl:p-20 print:p-2">
                        <table class="w-full text-left table-auto print:text-sm" id="table-items">
                            <thead>
                                <tr class="text-white bg-gray-700 print:bg-gray-300 print:text-black">
                                    <th class="px-4 py-2">Item</th>
                                    <th class="px-4 py-2 text-right">Qty</th>
                                    <th class="px-4 py-2 text-right">Unit Price</th>
                                    <th class="px-4 py-2 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4 py-2 border">Shared Hosting - Simple Plan (Monthly)</td>
                                    <td class="px-4 py-2 text-right border tabular-nums slashed-zero">1</td>
                                    <td class="px-4 py-2 text-right border tabular-nums slashed-zero">$2.45</td>
                                    <td class="px-4 py-2 text-right border tabular-nums slashed-zero">$2.45</td>
                                </tr>
                                <tr class="bg-gray-100 print:bg-gray-100">
                                    <td class="px-4 py-2 border">Domain Registration - coolstory.bro - (100% Free for First
                                        Year)</td>
                                    <td class="px-4 py-2 text-right border tabular-nums slashed-zero">1</td>
                                    <td class="px-4 py-2 text-right border tabular-nums slashed-zero">$12.00</td>
                                    <td class="px-4 py-2 text-right border tabular-nums slashed-zero">$0.00</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border">
                                        Dedicated Server - Eco Boost
                                        {{-- <div class="flex flex-col ml-4 text-xs print:hidden">
                                            <span class="flex items-center">Intel® Xeon® Processor E5-1607 v3</span>
                                            <span class="uppercase">32GB DDR4 RAM</span>
                                            <span>1TB NVMe / Raid 1+0</span>
                                            <span>1Gbps Network + CloudFlare DDoS protection</span>
                                        </div> --}}
                                    </td>
                                    <td class="px-4 py-2 text-right border tabular-nums slashed-zero">1</td>
                                    <td class="px-4 py-2 text-right border tabular-nums slashed-zero">$214.99</td>
                                    <td class="px-4 py-2 text-right border tabular-nums slashed-zero">$214.99</td>
                                </tr>
                                <tr class="bg-gray-100 print:bg-gray-100">
                                    <td class="px-4 py-2 border ">
                                        Dedicated Server - V8 Turbo
                                        <div class="flex flex-col ml-4 text-xs print:hidden">
                                            <span class="flex items-center">AMD EPYC™ 7702P</span>
                                            <span class="uppercase">128GB DDR4 RAM</span>
                                            <span>512GB NVMe / Raid 5</span>
                                            <span>100Mbit Network + CloudFlare DDoS protection</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 text-right border tabular-nums slashed-zero">1</td>
                                    <td class="px-4 py-2 text-right border tabular-nums slashed-zero">$322.45</td>
                                    <td class="px-4 py-2 text-right border tabular-nums slashed-zero">$322.45</td>
                                </tr>
                                <tr class="text-white bg-gray-700 print:bg-gray-300 print:text-black">
                                    <td class="invisible"></td>
                                    <td class="invisible"></td>
                                    <td class="px-4 py-2 font-extrabold text-right border">Total</td>
                                    <td class="px-4 py-2 text-right border tabular-nums slashed-zero">$685.66</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </content>
                <payment-history>
                    <div class="mt-20 mb-20 print:mb-2 print:mt-2">
                        <h2 class="text-xl font-semibold text-center print:text-sm">Payment History</h2>
                        <div class="flex flex-col items-center text-center print:text-sm"> Credit Card Payment: $685.66
                            (Mastercard
                            XXXX-XXXX-XXXX-0122)
                        </div>

                    </div>
                </payment-history>
                <footer
                    class="flex flex-col items-center justify-center pb-20 leading-loose text-white bg-gray-700 print:bg-white print:pb-0">
                    <span class="mt-4 text-xs print:mt-0">Invoice generated on 2020/09/06 17:35</span>
                    <span class="mt-4 text-base print:text-xs">© 2020 BroHosting. All rights reserved.</span>
                    <span class="print:text-xs">US - New York, NY 10023 98-2 W 67th St</span>
                </footer>
            </div>
            <div class="lg:w-1/12 xl:w-1/4"></div>
        </div>
    </div>
@endsection
