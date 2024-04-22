<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,max-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous"> -->
    <style>
        /* table {
        table-layout: fixed;
        }
        td {
        width: 150px;
        } */
        .required {
            display: flex;
            padding-top: 10px !important;
        }

        .icons-img {
            object-fit: contain;
        }

        .icon-image {
            padding-top: 1rem !important;
            /* padding-bottom: 0.3rem !important; */
        }

        .pt-2 {
            padding-top: 0.5rem !important;
        }

        .custom-box-table td {
            width: 125px !important
        }

        .w-50 {
            width: 50% !important;
        }

        .fl {
            float: left !important;
        }

        .fr {
            float: right !important;
        }

        .cb {
            clear: both !important;
        }

        .text-center {
            text-align: center !important;
        }

        .navbar-brand {
            display: inline-block;
            padding-top: 0.3125rem;
            padding-bottom: 0.3125rem;
            margin-right: 1rem;
            font-size: 1.25rem;
            line-height: inherit;
            white-space: nowrap;
        }

        .navbar-brand {
            color: rgba(0, 0, 0, 0.9);
        }

        .navbar-brand {
            color: #fff;
        }

        .font-weight-bold {
            font-weight: 700 !important;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group {
            display: -ms-flexbox;
            display: flex;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            -ms-flex-flow: wrap;
            flex-flow: wrap;
            -ms-flex-align: center;
            align-items: center;
            margin-bottom: 0;
        }

        .rounded {
            border-radius: 0.25rem !important;
        }



        .mx-0 {
            margin-right: 0 !important;
        }

        .mx-0 {
            margin-left: 0 !important;
        }

        .col-sm-2 {
            -ms-flex: 0 0 16.666667%;
            flex: 0 0 16.666667%;
            max-width: 16.666667%;
        }

        .col-sm-12 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }

        .col-md-3 {
            -ms-flex: 0 0 25%;
            flex: 0 0 25%;
            max-width: 25%;
        }

        .col-lg-2 {
            -ms-flex: 0 0 16.666667%;
            flex: 0 0 16.666667%;
            max-width: 16.666667%;
        }

        .px-2 {
            padding-right: 0.5rem !important;
        }

        .px-2 {
            padding-left: 0.5rem !important;
        }

        .mx-2 {
            margin-right: 0.5rem !important;
        }

        .mx-2 {
            margin-left: 0.5rem !important;
        }

        .col-md-7 {
            -ms-flex: 0 0 58.333333%;
            flex: 0 0 58.333333%;
            max-width: 58.333333%;
        }

        .col-lg-5 {
            -ms-flex: 0 0 41.666667%;
            flex: 0 0 41.666667%;
            max-width: 41.666667%;
        }

        .offset-lg-2 {
            margin-left: 16.666667%;
        }

        .mx-5 {
            margin-right: 3rem !important;
        }

        .mx-5 {
            margin-left: 3rem !important;
        }

        .input-group {
            width: auto;
        }

        .input-group {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -ms-flex-align: stretch;
            align-items: stretch;
            width: 100%;
        }

        .mx-3 {
            margin-right: 1rem !important;
        }

        .mx-3 {
            margin-left: 1rem !important;
        }

        .input-group-prepend {
            margin-right: -1px;
        }

        .input-group-text {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding: 0.375rem 0.75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            text-align: center;
            white-space: nowrap;
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .text-light {
            color: #f8f9fa !important;
        }

        .form-control {
            display: block;
            width: 100%;
            height: calc(1.5em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            /* font-size: 1rem; */
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control {
            transition: none;
        }

        .form-control {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .form-control {
            height: auto;
        }

        .form-control {
            display: inline-block;
            width: auto;
            vertical-align: middle;
        }

        .form-control-lg {
            padding-right: 0;
            padding-left: 0;
        }

        .form-control-lg {
            height: calc(1.5em + 1rem + 2px);
            padding: 0.5rem 1rem;
            font-size: 1.25rem;
            line-height: 1.5;
            border-radius: 0.3rem;
        }

        .overflow-hidden {
            overflow: hidden !important;
        }

        .col-md-2 {
            -ms-flex: 0 0 16.666667%;
            flex: 0 0 16.666667%;
            max-width: 16.666667%;
        }

        .py-3 {
            padding-top: 1rem !important;
        }

        .py-3 {
            padding-bottom: 1rem !important;
        }

        .col-md-1 {
            -ms-flex: 0 0 8.333333%;
            flex: 0 0 8.333333%;
            max-width: 8.333333%;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table {
            border-collapse: collapse !important;
        }

        .table-responsive-xl {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .col-2 {
            /* -ms-flex: 0 0 16.666667%;
            flex: 0 0 16.666667%; */
            max-width: 16.666667%;
        }

        .justify-content-center {
            -ms-flex-pack: center !important;
            justify-content: center !important;
        }

        /* .custom-table::after {
  content: "";
  position: absolute;
  top: 375px;
  right: 0;
  height: 143px;
  width: 1px;
  background-color: black;

} */
        /* .custom-table::before {
  content: "";
  position: absolute;
  top: 529px;
  right: 0;
  height: 410px;
  width: 1px;
  background-color: black;
}
tr:last-child::after {
    content: "";
  position: absolute;
  top: 938px;
  right: 0;
  height: 1px;
  width: 743px;
  background-color: black;
} */

    </style>
    <style>
        .table-heading {
            /* width: 1px !important */
        }

        .custom-table tr td {
            /* width:1px!important; */
        }

        #coin_to_sell {
            min-width: 140px;
            border-radius: 10px;
            background-color: #FFFFFF;
            height: 44px;
            border: 1px solid #ced4da;
            padding: 0.1rem 0.75rem;
        }

        .custom-container {
            margin-left: auto;
            margin-right: auto;
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Responsive custom container styles */
        @media(min-width: 576px) {

        /* Small devices (576px and up) */
        .custom-container {
            max-width: 720px;
            /* Increased from 540px */
        }
        }

        @media(min-width: 768px) {

        /* Medium devices (768px and up) */
        .custom-container {
            max-width: 960px;
            /* Increased from 720px */
        }
        }

        @media(min-width: 992px) {

        /* Large devices (992px and up) */
        .custom-container {
            max-width: 1200px;
            /* Increased from 960px */
        }
        }

        @media(min-width: 1200px) {

        /* Extra-large devices (1200px and up) */
        .custom-container {
            max-width: 1400px;
            /* Increased from 1140px */
        }
        }

        .custom-table .table-responsive {
            overflow-x: auto;
        }

        .custom-table {
            width: 100%;
        }

        .custom-box {
            margin-top: 20px !important;
            margin-right: 20px;
            display: inline-block !important;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            min-height: 200px;
            max-width: 200px;
        }

        .target-column {
            /* background-color: #00B050 !important; */
            /* color: white !important; */
        }

        .icon-cell {
            border: none !important;
        }

        .label-fixed-height {
            height: 110px;
            display: flex;
            align-items: center;
        }

        .label-fixed-height-nar {
            height: 15px;
            display: flex;
            align-items: center;
        }

        .custom-table {
            /* border: 2px solid #5C5B7B;
            border-collapse: separate;
            border-spacing: 0; */
        }

        .custom-table th {
            border: 1px solid black;
            padding: 5px;
            color: black !important;
            font-weight: normal;
        }

        .custom-table td {
            border: 1px solid black;
            padding: 5px;
        }


        .custom-table td,
        th {
            border-top: none !important;
            /* background-color: #5C5B7B; */
        }

        .custom-table .col-2 {
            /* width: 20.6667% !important; */
        }

        .invalid-feedback {
            display: block;
            color: red;
            font-size: 12px;
        }

        .custom-label {
            /* color: black; */
            min-height: 30px
        }

        .custom-label-new {
            /* color: black; */
            min-height: 50px
        }

        .custom-input {
            background-color: #4472C4 !important;
            border: none !important;
            border-radius: 10px 10px 10px 10px !important;
            padding-left: 5px !important;
            box-shadow: none !important;
            -moz-appearance: textfield;

        }

        .custom-input::-webkit-inner-spin-button,
        .custom-input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;


        }

        .custom-input::placeholder {
            color: white !important;
        }

        .custom-selectbox::placeholder {
            color: white;
        }

        .custom-selectbox {
            background-color: #4472C4 !important;
            border: none !important;
            color: #8589A4;
            border-radius: 10px !important;
            box-shadow: none !important;


        }

        .custom-span-rounded {
            border-radius: 10px 0px 0px 10px !important;
        }

        .custom-select2 {
            color: black !important;
            background-color: #4472C4 !important;
        }

        .select2-search__field {
            color: white !important;
            background-color: #4472C4 !important;
            border: none !important;
            outline: none;

        }

        .select2-selection {
            border: none !important;
            background-color: #4472C4 !important;
        }

        .select2-dropdown {
            border: none !important;
            background-color: #4472C4 !important;
        }

        .select2-results {
            color: white !important;
            font-size: 1rem;
            font-weight: bold;

        }

        .select2-selection__rendered {
            color: white !important;
            background-color: #4472C4 !important;
            font-size: 1rem;
            margin-top: 5px;
            font-weight: bold;

        }

        .select2-results__options {
            max-height: 200px;
            overflow-y: auto;
        }

        .select2-selection {
            outline: none;
        }

        .select2-results__options::-webkit-scrollbar {
            display: none;
        }

        .select2-results__options {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .custom-button-export {
            background-color: #4472C4 !important;
            border: none !important;
            border-radius: 10px !important;
            color: #6168AE !important;
            box-shadow: none !important;
            font-size: 1.5rem !important;
        }

        #export_select {
            color: #8589A4 !important;
        }

        #export_select option {
            font-size: 1.25rem;
            color: white;
            padding: 10px !important;
        }

        .form-control {
            color: white !important;
            /* font-size:11px!important; */
        }

        .table-warning {
            background: yellow !important;
            color: red !important;
        }

        .fa-percent,
        .fa-money-bill,
        .fa-coins {
            font-size: 1.25rem !important;
        }

        .input-group {
            width: 100% !important;
            margin: auto;
        }


        .form-group.text-center.rounded {
            display: block;
            width: 90%;
            margin: auto;
        }

        .column-main {
            width: 100%;
            max-width: 100%;
        }

        .column-1.child {
            float: left;
            width: 45%;
            text-align: left;
        }

        .column-1.child label.label-text {
            padding-right: 30px;
            s
        }

        .column-2.child {
            float: right;
            width: 45%;
            text-align: right;
        }

        input#coin_to_sell {
            width: 10% !important;
            padding: 0px !important;
            text-align: center;
        }

        .column-2.child label.label-text {
            padding-right: 15px;
            max-width: 50% !important;
        }

        .column-2.child label {
            text-align: left;
            height: auto !important;
            padding: 10px 50px;
            max-width: 50% !important;
            margin-top: 30px !important;

        }

        .form-group.text-right {
            display: block;
        }

        .w-100 {
            width: 100% !important;
        }

        .w-50 {
            width: 50% !important;
        }

        .w-45 {
            width: 45% !important;
        }

        .w-25 {
            width: 25% !important;
        }

        .w-75 {
            width: 75% !important;
        }

        .float-left {
            float: left !important;
        }

        .float-right {
            float: right !important;
        }

        .table-center-padding {
            /* padding-top:7px */
        }

        .clearfix {
            clear: both !important;
        }

        .form-control {
            border-radius: 10px !important;
            border-color: #4472C4 !important;
            border-width: 2px !important;
            background-color: #4472C4 !important;
            color: white !important;
        }

        .mr-50 {
            margin-right: 50px !important;
        }

        .mt-6 {
            margin-top: 20px !important;
        }

        .mt-5 {
            margin-top: 5px !important;
        }

        .mb-5 {
            margin-bottom: 5px !important;
        }

        .d-ib {
            display: inline-block !important;
        }

        .var {
            vertical-align: middle !important;
        }

        .ml-auto {
            margin-left: auto !important;
        }

        .text-right {
            text-align: right !important;
        }

        .pb-5 {
            padding-bottom: 5px !important;
        }

        .card {
            border: 1px solid grey;
        }

        .rounded-md {
            border-radius: 10px !important;
        }

        .p-3 {
            padding: 6px !important;
        }

        .p-10 {
            padding: 1px !important;
        }

        .text-center {
            text-align: center !important;
        }

        .mt-100 {
            margin-top: 100px !important;
        }

        .m-15 {
            margin: 15px !important;
        }

        .t1 {
            border-collapse: separate;
        }
        /* Your CSS styles for modal here */
#receiptContainer {
  font-family: "Helvetica Neue", Helvetica, "Segoe UI", Arial, sans-serif;
  font-size: 13px;
}
table#recipt {
  font-size: 19px;
  font-weight: 600;
}
.inner-content.title-section {
  font-size: 18px;
  border-bottom: 1px solid;
  padding-top: 12px;
}
.title-section {
  font-size: 18px;
  border-bottom: 1px solid;
  padding-top: 12px;
}
img.img-logo {
  width: 100%;
  max-width: 112px;
}
#receiptContainer .container {
  margin-top: 40px;
}
#receiptContainer .col-md-6,
#receiptContainer .col-xs-6 {
  width: 50%;
}

#receiptContainer .col-md-7,
#receiptContainer .col-xs-7 {
  width: 58.333333%;
}
.detail-receipt .title-section {
  font-size: 23px;
  border-bottom: 1px solid;
  padding-top: 19px;
  font-weight: 700;
  padding-left: 11px;
}

#receiptContainer.col-md-5,
#receiptContainer.col-xs-5 {
  width: 41.666667%;
}

#receiptContainer .row {
  display: flex;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px;
}

#receiptContainer .text-right {
  text-align: right;
}

#receiptContainer img {
  width: 100px;
  height: 120px;
}

#receiptContainer .title-section {
  font-size: 16px;
  letter-spacing: 1px;
  border-bottom: 2px #666666 solid;
  padding-bottom: 10px;
}

#receiptContainer table {
  width: 100%;
  margin-top: 20px;
}

#recipt td {
  border: 1px solid #666666;
  border-collapse: collapse;
}

#receiptContainer th,
td {
  padding: 10px;
}

#receiptContainer hr {
  border-top: 1px solid #666666;
}
table#recipt {
  width: 100%;
}

table#recipt td {
  text-align: center !important;
}
.time-date {
  font-size: 20px;
}

.time-date:first-child {
  font-weight: 300;
  font-size: 18px;
}

.border-bottom {
  border-bottom: 1px solid !important;
}
.modal-backdrop {
  position: absolute !important;
}

    </style>
</head>

<body
    style="min-height: 100vh;padding-bottom:20px;background-color: white !important;  font-family: sans-serif;font-size: 11px !important;width:100%; ">
    <div>
        <div class="">
            <div class="logo text-center">
                <img clas src="{{ public_path('images/logo.png') }}" alt="" srcset="" width="100"
                    height="100">
            </div>

            <div class="mt-5" id="print">
                <h3 class="text-center navbar-text" style="color:black;font-size:1rem;"><span
                        style="font-weight:bold;font-style:italic">Crypto Wiz
                        Guy<sup>&trade;</sup></span> presents <br />
                    <span style="font-weight:bold;color:#28a745">The Selling-for-PROFIT Calculator</span>
                </h3>
            </div>

            <div class="info-text text-center">
                <label style="margin-bottom:0px">IMPORTANT: Save as PDF or print before closing, resetting, reloading,
                    or
                    leaving this page.<br>
                    <label class="font-weight-bold w-100" style="text-align:center;vertical-align:top">Crypto Wiz Guy
                        does
                        not save your work.</label><br>

                    <label class="mt-2">IMPORTANT: See here for entering Investor's output data into Coinbase. The
                        Calculator
                        does not make a sale or place an
                        order on Coinbase.</label>
            </div>


            <div class="container" id="receiptContainer">
                <div class="row">
                    <!-- <div class="col-md-6 col-xs-6">Company LTD 2016</div> -->
                    <div class="col-md-6 col-xs-6 text-right">
                        Date: {{ $formattedDate }}
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-xs-7 text-right">
                        <a href="javascript:void()" v-on:click="() => $router.push('/')"><img :src="Logo" alt="logo"
                                class="img-logo" /></a>
                    </div>
                    <div class="col-md-5 col-xs-5 text-right" style="padding-top: 20px">
                        <div style="
                      font-size: 18px;
                      font-weight: bold;
                      padding-bottom: 6px;
                    ">
                            Name {{ $first_name }} {{ $last_name }}
                        </div>
                        <!-- <div style="padding-bottom: 6px">
                    Address: 9 Portland Gardens
                  </div>
                  <div>Post code: N4 1HU</div> -->
                    </div>
                </div>
            </div>



            <div class="container">
                <div class="column-table">
                    <div class="title-section">
                        <h3>RECIPIENT DETAILS</h3>
                    </div>
                    <table id="recipt">
                        <thead>
                            <tr>
                                <td> SUBSCRIPTION NAME</td>
                                <td style="text-align: center">STRIPE PRICE</td>
                                <td style="text-align: right">QUANTITY</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $subscriptionName }}</td>
                                <td style="text-align: center">
                                    {{ $subscriptionPrice }} $
                                </td>
                                <td style="text-align: right">1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="container">
                <div class="detail-receipt">
                    <div class="title-section">TRANSACTION DETAILS</div>
                    <div class="row" style="margin-top: 20px"></div>
                </div>
                <div class="radio-cards">
                    <div class="inner-content" style="display: flex">
                        <div class="content-sect">
                            <div class="value-text justify-content-left text-left pl-3 pb-0">
                                <h4>
                                    {{ $subscriptionName }}
                                    <span class="capital-duration">({{ $regisitrationDiscount }})</span>
                                </h4>
                            </div>
                            <div class="price-month">
                                <p>{{ $subscriptionPrice }} $</p>
                            </div>
                        </div>
                    </div>

                    <div class="inner-content border-buttom" style="display: flex">
                        <div class="content-sect">
                            <div class="value-text justify-content-left text-left pl-3 pb-0">
                                <h4>
                                    Registration Discount
                                    <span class="capital-duration">({{ $regisitrationDiscount }} %)</span>
                                </h4>
                            </div>
                            <div class="price-month">
                                <p>
                                    {{
                            ($subscriptionPrice / 100) *
                          $regisitrationDiscount
                        }}
                                    $
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="inner-content" style="display: flex">
                        <div class="content-sect">
                            <div class="value-text justify-content-left text-left pl-3 pb-0">
                                <h4>Payable</h4>
                            </div>
                            <div class="price-month">
                                <p>
                                    {{
                          ($subscriptionPrice / 100) *
                          $discountAmount
                        }}.00 $
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- The part of HTML where you want to display discount information -->
                    <div class="inner-content border-buttom" v-if="discount">
                        <div class="content-sect">
                            <div class="value-text justify-content-left text-left pl-3 pb-0">
                                <h4>
                                    Discount
                                    <span class="capital-duration">({{ $discountAmount }} %)</span>
                                </h4>
                            </div>

                            <div class="price-month">
                                <p>{{ $discountAmount }} $</p>
                            </div>
                        </div>
                    </div>

                    <div class="inner-content" v-if="discount">
                        <div class="content-sect">
                            <div class="value-text justify-content-left text-left pl-3 pb-0">
                                <h3>Payable Total</h3>
                            </div>
                            <div class="price-month">
                                <p>{{ $payableTotal }} $</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container" style="margin-top: 50px; font-weight: 300">
                <div class="col-md-12" style="text-align: center">
                    <div>
                        The transaction shown on your receipt is correct at the time
                        of downloading.
                    </div>

                </div>
            </div>


        </div>
    </div>

</body>

</html>
