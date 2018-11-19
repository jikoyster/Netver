<link rel="stylesheet" type="text/css" href="{{ asset('assets/calculator/jquery.calculator.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/calculator/black-tie-jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/datepicker/datepicker.css')}}">
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
<style type="text/css">
    .date-input { padding: 7px; }
    .select2-container { float: inherit; }
    .select2-selection { height: 36px !important; }
    #select2-sel_account-container,
    #select2-sel_segment-container,
    #select2-sel_job_project-container,
    #select2-location-container,
    #select2-segment1-container,
    #select2-job_project1-container {
        text-align: left;
        padding: 3px 14px;
    }
    table.table td:nth-child(1) {
        max-width: 0 !important;
        padding: 0 !important;
        visibility: hidden;
    }
    .spacer { padding: 50px 0; }
    .ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight {
        background: #111;
        color: #fff;
    }

    .glyphicon {
        cursor: pointer;
    }
    .glyphicon-edit {
        color: #3097D1;
    }
    .glyphicon-trash {
        color: red;
    }
    .glyphicon-floppy-saved,
    .glyphicon-plus {
        color: #2ab27b;
    }
    .clearfix {
        margin: 17px 0;
    }
    .new-entry td {
        vertical-align: middle !important;
    }

    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 22px;
        width: 22px;
        background-color: #fff;
        border: solid 1px #ccc;
    }
    .container-check {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }.container-check input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
    }

    /* On mouse-over, add a grey background color */
    .container-check:hover input ~ .checkmark {
        background-color: #fff;
    }

    /* When the checkbox is checked, add a blue background */
    .container-check input:checked ~ .checkmark {
        background-color: #fff;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container-check input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container-check .checkmark:after {
        left: 6px;
        top: 2px;
        width: 8px;
        height: 14px;
        border: solid #000;
        border-width: 0 5px 5px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .locked,
    .locked-split {
        background-color: #62beff !important;
        transition: 1s;
        color: #fff;
    }
    .locked .glyphicon-floppy-saved,
    .locked-split .glyphicon-floppy-saved {
        padding: 4px 4px 4px 5px;
        background: #fff;
        border-radius: 7px;
        color: #2ab27b;
    }
    .entry-locked {
        display: none !important;
    }
    .table tbody.from-database,
    .table tbody.from-database-split {
      display:block;
      overflow-y:scroll;
      max-height:595px;
      width:100%;
    }
    .table thead tr,
    .new-entry,
    .new-entry-split,
    .from-database + tbody tr,
    .from-database-split + tbody tr {
      display:block;
    }
    /* line */
    .table.main-journal-table td:nth-child(2) {
        width: 50px;
    }
    /* description */
    .table.main-journal-table td:nth-child(3) {
        width: 281px;
    }
    /* date */
    .table.main-journal-table td:nth-child(4) {
        width: 120px;
    }
    /* account */
    .table.main-journal-table td:nth-child(5) {
        width: 100px;
    }
    /* debit */
    .table.main-journal-table td:nth-child(6) {
        width: 150px;
    }
    /* deb-cad */
    .table.main-journal-table td:nth-child(7) {
        width: 90px;
        padding-left: 0;
        text-align: left;
    }
    /* credit */
    .table.main-journal-table td:nth-child(8) {
        width: 150px;
    }
    /* cred-cad */
    .table.main-journal-table td:nth-child(9) {
        width: 90px;
        padding-left: 0;
        text-align: left;
    }
    /* segment */
    .table.main-journal-table td:nth-child(10) {
        width: 200px;
    }
    /* job / project */
    .table.main-journal-table td:nth-child(11) {
        width: 200px;
    }
    /* add-new button */
    .table.main-journal-table td:nth-child(12) {
        width: 50px;
    }
    /* flag */
    .table.main-journal-table td:nth-child(13) {
        width: 50px;
    }
    /* note */
    .table.main-journal-table td:nth-child(14) {
        width: 50px;
    }
    /* action */
    .table.main-journal-table td:nth-child(15) {
        width: 65px;
    }
    .split-table td:nth-child(2) {
        width: 7%;
    }
    .split-table td:nth-child(3) {
        width: 28.75%;
    }
    .split-table td:nth-child(4) {
        width: 7%;
    }
    .split-table td:nth-child(5) {
        width: 14.25%;
    }
    .split-table td:nth-child(6) {
        width: 20%;
    }
    .split-table td:nth-child(7) {
        width: 50px;
    }
    .split-table td:nth-child(8) {
        width: 50px;
    }
    .split-table td:nth-child(9) {
        width: 95px;
    }
    nav.navbar { margin-bottom: 0; }
    .footer .container { margin-top: 0; }
    .btn-currency-code {
        background-color: #333;
        color: #fff;
        font-weight: bold;
        margin-left: 1px;
        width: 36px;
        height: 36px;
        padding: 0;
        border-radius: 0;
    }
    .locked .btn-currency-code,
    .locked .btn-currency-code + button,
    .locked-split .btn-currency-code,
    .locked-split .btn-currency-code + button {
        margin-top: 0;
        height: 35px;
        width: 35px;
    }
    tbody { border: none !important; }
    button.calculator-trigger {
        width: 36px;
        float: right;
        border: none;
        background-color: transparent;
    }
    button.calculator-trigger img { width: 100%; }
    .locked button.calculator-trigger,
    .locked-split button.calculator-trigger {
        width: 35px;
    }
    .is-calculator {
        width: 74%;
        float: left;
    }
    #debit-edit,#credit-edit {
        padding-right: 0;
    }
    .popover-content {
        color: #636b6f;
    }
</style>