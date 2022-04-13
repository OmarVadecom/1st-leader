<?php $__env->startSection('style'); ?>
<style>
    .errortable,
    .showunitstable {
        display: none;
    }

    th {
        vertical-align: middle;
    }

    button {
        font-weight: normal;
    }

    .rowhidden {
        display: none;
    }

    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 6px 10px;
        transition: 0.3s;
        font-size: 16px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #fff;
        border-bottom: 2px solid red;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border-top: none;
    }


    .tabcontent {
        animation: fadeEffect 1s;
        /* Fading effect takes 1 second */
    }

    /* Go from zero to full opacity */
    @keyframes  fadeEffect {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    td,
    th {
        padding: 5px 5px !important;
    }

    .select2 {
        width: 100% !important;
    }

    .select2-container {
        font-size: 14px !important;
        text-align: right !important;
        ;
    }

    th {
        text-align: center !important;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background: #dff0d8 !important;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background: #f2dede !important;
    }

    .totals {
        font-weight: bold;
    }

    .clickremrow {
        background: antiquewhite;
        padding: 12px;
        cursor: pointer;
        color: red;
    }

    .installment,
    .delayed,
    .installment_dates {
        display: none;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
    .installment,
    .installment_dates {
      display: none;
    }

    .fa-star {
      color: #ffc12b;
      font-size: 15px;
    }

</style>
<?php $__env->stopSection(); ?>
