<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/calculator/jquery.plugin.js') }}"></script> 
<script type="text/javascript" src="{{ asset('assets/calculator/jquery.calculator.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('/js/select2.min.js')}}"></script>
<script type="text/javascript">
    $(function(){
        var theTotalDebit = Number('{{$tot_dbt}}');
        var theTotalCredit = Number('{{abs($tot_crt)}}');
        addCommas = function(nStr){
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
        var updateError = true;
        var updateSplitError = true;
        $('.add-note').click(function(){
            $('[name=note]').val($('.popup-note').val());
            if($('[name=note]').val())
                $('.add-note-symbol').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            else
                $('.add-note-symbol').removeClass('glyphicon-plus').addClass('glyphicon-minus');
        });
        $('.edit-note').click(function(){
            $('#gjournal-'+$('[name=theid]').val()).find('#note-edit textarea').val($('.popup-edit-note').val());
            if($('#gjournal-'+$('[name=theid]').val()).find('#note-edit textarea').val())
                $('#gjournal-'+$('[name=theid]').val()).find('.edit-note-symbol').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            else
                $('#gjournal-'+$('[name=theid]').val()).find('.edit-note-symbol').removeClass('glyphicon-plus').addClass('glyphicon-minus');
        });
        $('.add-note-split').click(function(){
            $('[name=note_split]').val($('.popup-note-split').val());
            if($('[name=note_split]').val())
                $('.add-note-split-symbol').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            else
                $('.add-note-split-symbol').removeClass('glyphicon-plus').addClass('glyphicon-minus');
        });
        $('.edit-note-split').click(function(){
            $('#gjournal-split-'+$('[name=theid]').val()).find('#note-edit textarea').val($('.popup-edit-note-split').val());
            if($('#gjournal-split-'+$('[name=theid]').val()).find('#note-edit textarea').val())
                $('#gjournal-split-'+$('[name=theid]').val()).find('.edit-note-split-symbol').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            else
                $('#gjournal-split-'+$('[name=theid]').val()).find('.edit-note-split-symbol').removeClass('glyphicon-plus').addClass('glyphicon-minus');
        });
        $('[name=account],[name=segment],[name=job_project]').next().css('width','150px');
        addCommas = function(nStr){
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
        $('[name=account').change(function(){
            setTimeout(()=>{
                if($(this).val())
                    $(this).next().find('#select2-sel_account-container').html($(this).val()).css('text-align','left');
            },200);
        }).change();
        $('[name=segment1').change(function(){
            $('[name=segment]').val($(this).val()).change();
        }).change();
        $('[name=job_project1').change(function(){
            $('[name=job_project]').val($(this).val()).change();
        }).change();

        /* custom new */
        var theEditables = function() {
            $('[name=account],[name=segment],[name=job_project],[name=location],[name=segment1],[name=job_project1]').select2({dropdownAutoWidth:true});
            $('.from-database').scrollTop($('.from-database').height());
            $(document).scrollTop($(document).height());
            $('[name=description]').focus();
            $('.editables').off().on('click',function(){
                if($(this).attr('class') == 'editables') {
                    if($('.locked').html()) {
                        $('.locked').find('.update-niel').click();
                        setTimeout(()=>{
                            if(updateError == false) {
                                updateError = true;
                                $(this).click();
                            }
                        },1000);
                    } else {
                        $(this).attr('class','locked');
                        $('.new-entry').addClass('entry-locked').find('input, select, a').attr('disabled',true);
                        $('.add-note-symbol').attr('data-target','');
                        var description = $(this).find('#description');
                        var date = $(this).find('#date');
                        var account = $(this).find('#account');
                        var debit = $(this).find('#debit');
                        var debCur = debit.next();
                        var credit = $(this).find('#credit');
                        var creCur = credit.next();
                        var segment = $(this).find('#segment');
                        var job_project = $(this).find('#job_project');
                        var flag = $(this).find('#flag');
                        var note = $(this).find('#note');
                        var action = $(this).find('#action');

                        var descriptionElem = $('<input class="form-control">')
                            .css('text-align','left')
                            .val(description.html());
                        description.attr('id',description.attr('id')+'-edit').html(descriptionElem);
                        var dateElem = $('<input class="form-control date-input">')
                            .val(date.html())
                            .attr('placeholder','YYYY-MM-DD')
                            .css('text-align','center')
                            .datepicker({format:'yyyy-mm-dd'})
                            .on('changeDate',function(e){
                                if(e.viewMode == 'days') {
                                    $( this ).datepicker('hide');
                                    $(this).css('text-align','right');
                                }
                            });
                        date.attr('id',date.attr('id')+'-edit').html(dateElem);

                        var accountElem = $('<select class="form-control" id="sel_account">').html($('[name=account]').html()).change(function(){
                            setTimeout(()=>{
                                if($(this).val())
                                    $(this).next().find('#select2-sel_account-container').html($(this).val()).css('text-align','left');
                            },200);
                        });
                        if(account.html())
                            accountElem.val(account.html());
                        else
                            accountElem.val($('[name=account]').val());
                        account.attr('id',account.attr('id')+'-edit').html(accountElem);
                        accountElem.select2({dropdownAutoWidth:true}).change();

                        var segmentElem = $('<select class="form-control" id="sel_segment">').html($('[name=segment]').html());
                        if(segment.html())
                            segmentElem.val(segment.html());
                        else
                            segmentElem.val($('[name=segment1]').val());
                        segment.attr('id',segment.attr('id')+'-edit').html(segmentElem);
                        segmentElem.select2({dropdownAutoWidth:true});

                        var job_projectElem = $('<select class="form-control" id="sel_job_project">').html($('[name=job_project]').html());
                        if(job_project.html())
                            job_projectElem.val(job_project.html());
                        else
                            job_projectElem.val($('[name=job_project1]').val());
                        job_project.attr('id',job_project.attr('id')+'-edit').html(job_projectElem);
                        job_projectElem.select2({dropdownAutoWidth:true});

                        var flagElem = $('<input type="checkbox" class="form-control pull-right">').prop('checked',flag.find('input').prop('checked'));
                        var containerElem = '<label class="container-check pull-left">';
                        if(flag.find('input').prop('checked'))
                            containerElem += '<input type="checkbox" class="form-control pull-right" checked>';
                        else
                            containerElem += '<input type="checkbox" class="form-control pull-right">';
                        containerElem += '<span class="checkmark"></span>';
                        containerElem += '</label>';
                        flag.attr('id',flag.attr('id')+'-edit').html(containerElem);

                        var noteElem = $('<textarea class="form-control">')
                            .css('visibility','hidden')
                            .css('width','0')
                            .css('position','absolute')
                            .val(note.find('span').data('content'));
                        var noteGlyph = $('<button class="glyphicon edit-note-symbol" data-toggle="modal" data-target=".bs-edit-modal" style="border:unset; background-color:transparent;">')
                            .css('color','inherit')
                            .css('font-weight','bold')
                            .click(function(){
                                $('[name=theid]').css('color','#000').val($(this).parent().parent().find('#id').html());
                                $('.popup-edit-note').val($(this).parent().find('textarea').val());
                            });
                        if(noteElem.val())
                            noteGlyph.addClass('glyphicon-plus');
                        else
                            noteGlyph.addClass('glyphicon-minus');
                        note.attr('id',note.attr('id')+'-edit').html(noteElem).append(noteGlyph);

                        var debitElem = $('<input class="form-control">')
                            .css('text-align','right')
                            .focus(function(){
                                val = $(this).val();
                                $(this).val(val.replace(/,/g,'')).select();
                            }).val(debit.html() ? action.find('input').val():'').keyup(function(e){
                                if(e.keyCode == 17)
                                    $(this).calculator('hide');
                            }).mousedown(function(e){
                                if(e.which == 3)
                                    $(this).calculator('hide');
                            });
                        debit.attr('id',debit.attr('id')+'-edit').html(debitElem);
                        debit.find('input').calculator({
                            showOn:'button',
                            //buttonImageOnly:true,
                            buttonImage:'/storage/images/calculator-icon-1.png',
                            layout:['','_1_2_3_+','_4_5_6_-','_7_8_9_*','_0_._=_/',$.calculator.USE+$.calculator.ERASE], 
                            useThemeRoller: true
                        });

                        debCur.html($('[name=debit]').parent().next().html());
                        debCur.find('.btn-split').click(function(){
                            var acc_no = $(this).parent().parent().find('#account-edit select option:selected').val();
                            var deb = $(this).parent().parent().find('#debit-edit input').val();
                            var t_l_no = $(this).parent().parent().find('#transaction_line_no').html();
                            if(deb)
                                $('.bs-split-transaction-modal').modal('show');
                            /*$('#amount-to-split-label').val(deb);*/
                            $('#account-no-label').html(acc_no);
                            splitTransactionTable(t_l_no,acc_no,deb);
                        });
                        creCur.html($('[name=credit]').parent().next().html());
                        creCur.find('.btn-split').click(function(){
                            var acc_no = $(this).parent().parent().find('#account-edit select option:selected').val();
                            var cred = $(this).parent().parent().find('#credit-edit input').val();
                            var t_l_no = $(this).parent().parent().find('#transaction_line_no').html();
                            if(cred)
                                $('.bs-split-transaction-modal').modal('show');
                            /*$('#amount-to-split-label').val(cred);*/
                            $('#account-no-label').html(acc_no);
                            splitTransactionTable(t_l_no,acc_no,cred);
                        });

                        var creditElem = $('<input class="form-control">')
                            .css('text-align','right')
                            .focus(function(){
                                val = $(this).val();
                                $(this).val(val.replace(/,/g,'')).select();
                            }).val(credit.html() ? addCommas(Number(-1*action.find('input').val().replace(/,/g, '')).toFixed(5)):'')
                            .blur(function(){
                            }).keyup(function(e){
                                if(e.keyCode == 17)
                                    $(this).calculator('hide');
                            }).mousedown(function(e){
                                if(e.which == 3)
                                    $(this).calculator('hide');
                            });
                        credit.attr('id',credit.attr('id')+'-edit').html(creditElem);
                        credit.find('input').calculator({
                            showOn:'button',
                            buttonImage:'/storage/images/calculator-icon-1.png',
                            layout:['','_1_2_3_+','_4_5_6_-','_7_8_9_*','_0_._=_/',$.calculator.USE+$.calculator.ERASE], 
                            useThemeRoller: true
                        });

                        debCur.parent().find('.btn-split img').attr('src','/img/split-b.png').removeClass('split-r');
                        if(job_project.next().attr('data-selected') == 1) {
                            if(debitElem.val())
                                debCur.find('.btn-split img').attr('src','/img/split-r.png').addClass('split-r').click();
                            if(creditElem.val())
                                creCur.find('.btn-split img').attr('src','/img/split-r.png').addClass('split-r').click();
                        } else if(job_project.next().attr('data-selected') == 2) {
                            if(debitElem.val())
                                debCur.find('.btn-split img').attr('src','/img/split-g.png');
                            if(creditElem.val())
                                creCur.find('.btn-split img').attr('src','/img/split-g.png');
                        }

                        var actionElem = $('<button class="glyphicon glyphicon-floppy-saved update-niel" style="border:unset;"></button>')
                            .click(function(){
                                $.post('<?=route('g-journal.edit')?>', {
                                    _token: '{{csrf_token()}}',
                                    id: $(this).parent().parent().find('#id').html(),
                                    description: $(this).parent().parent().find('#description-edit > input').val(),
                                    date: $(this).parent().parent().find('#date-edit > input').val(),
                                    account: $(this).parent().parent().find('#account-edit > select').val(),
                                    debit: $(this).parent().parent().find('#debit-edit > input').val().replace(/,/g,''),
                                    credit: $(this).parent().parent().find('#credit-edit > input').val().replace(/,/g,''),
                                    segment: $(this).parent().parent().find('#segment-edit > select').val(),
                                    job_project: $(this).parent().parent().find('#job_project-edit > select').val(),
                                    flag: $(this).parent().parent().find('#flag-edit input').prop('checked'),
                                    note: $(this).parent().parent().find('#note-edit > textarea').val(),
                                    split_selected: $(this).parent().parent().find('#job_project-edit').next().attr('data-selected')
                                }).success((data)=>{
                                    window.location.href='{{route('g-journals')}}';
                                    /*$('.new-entry').removeClass('entry-locked').find('input, select, a').attr('disabled',false);
                                    $('.add-note-symbol').attr('data-target','.bs-add-modal');
                                    var d = new Date(data.date);
                                    var month = (d.getMonth() + 1);
                                    var day = d.getDate();
                                    var debit = '';
                                    var credit = '';
                                    var amount = data.amount.replace(/,/g, "");
                                    var splitBtn = '';
                                    var splitBtnC = '';
                                    if(month < 10)
                                        month = '0'+month;
                                    if(day < 10)
                                        day = '0'+day;
                                    if(amount < 0) {
                                        credit = Math.abs(amount);
                                        if( credit > 0) {
                                            if(data.split_selected == 1)
                                                splitBtnC = '<button class="btn pull-left btn-split" style="background-color: transparent; padding: 0px 0px 0px 2px;"><img src="/img/split-r.png" class="split-r" style="width: 22px;"></button>';
                                            else if(data.split_selected == 2)
                                                splitBtnC = '<button class="btn pull-left btn-split" style="background-color: transparent; padding: 0px 0px 0px 2px;"><img src="/img/split-g.png" style="width: 22px;"></button>';
                                            credit = parseFloat(Number(credit)).toFixed(2).toLocaleString('en');
                                        }
                                        else
                                            credit = '';
                                    } else {
                                        debit = amount;
                                        if(debit > 0) {
                                            if(data.split_selected == 1)
                                                splitBtn = '<button class="btn pull-left btn-split" style="background-color: transparent; padding: 0px 0px 0px 2px;"><img src="/img/split-r.png" class="split-r" style="width: 22px;"></button>';
                                            else if(data.split_selected == 2)
                                                splitBtn = '<button class="btn pull-left btn-split" style="background-color: transparent; padding: 0px 0px 0px 2px;"><img src="/img/split-g.png" style="width: 22px;"></button>';
                                            debit = parseFloat(Number(debit)).toFixed(2).toLocaleString('en');
                                        }
                                        else
                                            debit = '';
                                    }
                                    $(this).parent().parent().attr('class','editables');
                                    $(this).parent().parent().find('#description-edit').attr('id','description').html(data.description);
                                    $(this).parent().parent().find('#date-edit').attr('id','date').html(d.getFullYear()+'-'+month+'-'+day);                                    
                                    $(this).parent().parent().find('#account-edit').attr('id','account').html(data.account);                                    
                                    $(this).parent().parent().find('#debit-edit').attr('id','debit').html(addCommas(debit)).next().html(splitBtn);
                                    $(this).parent().parent().find('#credit-edit').attr('id','credit').html(addCommas(credit)).next().html(splitBtnC);                                    
                                    $(this).parent().parent().find('#segment-edit').attr('id','segment').html(data.segment);                                                                        
                                    $(this).parent().parent().find('#job_project-edit').attr('id','job_project').html(data.job_project);                                
                                    if(data.flag)
                                        flag = '<label class="container-check pull-left"><input type="checkbox" class="form-control pull-right" checked><span class="checkmark"></span></label>';
                                    else
                                        flag = '<label class="container-check pull-left"><input type="checkbox" class="form-control pull-right"><span class="checkmark"></span></label>';
                                    $(this).parent().parent().find('#flag-edit').attr('id','flag').html(flag);
                                    if(data.note)
                                        note = "<span style='font-weight:bold; cursor:pointer; color:inherit;' class='glyphicon glyphicon-plus' tabindex='0' data-trigger='focus' data-toggle='popover' data-placement='top' title='Note' data-content=\""+data.note+"\"></span>";
                                    else
                                        note = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-minus'></span>";
                                    $(this).parent().parent().find('#note-edit').attr('id','note').html(note);
                                    $(this).parent().parent().find('#action-edit').attr('id','action').html('<input type="hidden" value="'+data.amount+'"><span class="glyphicon glyphicon-edit" style="margin-right: 12px;"></span> <span class="glyphicon glyphicon-trash delete-niel"></span>');

                                    var total_debit = $('#total_debit');
                                    total_debit.html(addCommas(parseFloat(Number(data.total_debit)).toFixed(2).toLocaleString('en')));
                                    var total_credit = $('#total_credit');
                                    total_credit.html(addCommas(parseFloat(Number(data.total_credit)).toFixed(2).toLocaleString('en')));
                                    if(parseFloat(-1*(Number(data.total_debit) - Number(data.total_credit))).toFixed(5) == Number(0).toFixed(5) && $('.split-r').length < 1)
                                        $('#total_action').html('<a class="btn btn-primary" href="{{route('g-journal.post')}}">POST</a>');
                                    else
                                        $('#total_action').html('');
                                    $('#total_balance').html('Out of Balance:&nbsp;&nbsp; '+(addCommas(parseFloat(-1*(Number(data.total_debit) - Number(data.total_credit))).toFixed(5).toLocaleString('en'))));
                                    if($('select').length < 10)
                                        $('[name=account],[name=segment],[name=job_project],[name=location],[name=segment1],[name=job_project1]').select2({dropdownAutoWidth:true});
                                    theEditables();
                                    updateError = false;*/
                                }).error((error)=>{
                                    updateError = true;
                                    $('.select2-selection__rendered').css('background-color','inherit');
                                    $('input').css('background-color','#fff');
                                    window.scrollTo(0, 0);
                                    var hold = '<div class="alert spacer text-center">';
                                    $(this).parent().parent().find('#description-edit > input').css('background-color','#fff');
                                    $(this).parent().parent().find('#date-edit > input').css('background-color','#fff');
                                    $(this).parent().parent().find('#segment-edit #select2-sel_segment-container').css('background-color','#fff');
                                    jQuery.each(error.responseJSON.errors, (i,val)=> {
                                        hold += '<h4><strong class="text-red">'+val+'</strong></h4>';
                                        if(i == 'segment') 
                                            $(this).parent().parent().find('#segment-edit #select2-sel_segment-container').css('background-color','#f1b9b8');
                                        else if(i == 'date')
                                            $(this).parent().parent().find('#date-edit > input').css('background-color','#f1b9b8');
                                        else if(i == 'description')
                                            $(this).parent().parent().find('#description-edit > input').css('background-color','#f1b9b8');
                                        else if(i == 'account')
                                            $('#select2-sel_account-container').css('background-color','#f1b9b8');
                                        else if(i == 'debit')
                                            $('#debit-edit > input,#credit-edit > input').css('background-color','#f1b9b8');
                                            
                                    });
                                    hold += '</div>';
                                    $('.ajax-alert').html(hold).fadeTo(7000, 500).slideUp(1000, function(){
                                        $(".alert").slideUp();
                                    });
                                });
                            });
                        var holdActionInput = action.find('input').val();
                        action.attr('id',action.attr('id')+'-edit').html(actionElem).append('<input type="hidden" value="'+Math.abs(holdActionInput.replace(/,/g,'')).toFixed(5)+'">');
                    }
                }
            });
            $('.delete-niel').off().on('click',function(e){
                e.stopImmediatePropagation();
                $('.bs-delete-modal').modal();
                $('#delete-name').html('line #'+$(this).parent().parent().find('#transaction_line_no').html());
                $('[name=id]').val($(this).parent().parent().find('#id').html());
            });
            $('[data-toggle="popover"]').popover({trigger:'hover'});
        }
        var updateTransLineNo = function(elem) {
            var own_tr = $(elem).parent().parent();
            var next_tr = own_tr.next();
            var hold_tans_line_no = own_tr.find('#transaction_line_no').html();
            var next_tras_line_no = next_tr.find('#transaction_line_no').html();
            if(next_tras_line_no) {
                next_tr.find('#transaction_line_no').html(hold_tans_line_no);
                updateNextTransLineNo(next_tr,next_tras_line_no);
            }
        }
        var updateNextTransLineNo = function(own_tr, hold_tans_line_no) {
            var next_tr = own_tr.next();
            var next_tras_line_no = next_tr.find('#transaction_line_no').html();
            if(next_tras_line_no) {
                next_tr.find('#transaction_line_no').html(hold_tans_line_no);
                updateNextTransLineNo(next_tr,next_tras_line_no);
            }
        }
        theEditables();
        $('[name=date]').attr('placeholder','YYYY-MM-DD')
        .css('text-align','left')
        .datepicker({format:'yyyy-mm-dd',defaultDate: new Date()})
        .on('changeDate',function(e){
            if(e.viewMode == 'days') {
                $( this ).datepicker('hide');
                $(this).css('text-align','left');
            }
        });
        var theKeyup = function(e,this_is) {
            var someDate = new Date($(this_is).val());
            if(e.keyCode == 37)
                var addNumberOfDaysToAdd = -1;
            if(e.keyCode == 38)
                var addNumberOfDaysToAdd = -7;
            if(e.keyCode == 39)
                var addNumberOfDaysToAdd = 1;
            if(e.keyCode == 40)
                var addNumberOfDaysToAdd = 7;
            //someDate.setDate(someDate.getDate() + addNumberOfDaysToAdd);
            var dd = someDate.getDate() + addNumberOfDaysToAdd;
            var mm = someDate.getMonth() + 1;
            if(mm < 10)
                mm = '0'+mm;
            var y = someDate.getFullYear();
            var someFormattedDate = y + '-'+ mm + '-'+ dd;
            $(this_is).val(someFormattedDate).datepicker('setValue',someFormattedDate);
        }
        $('[name=date]').on('keyup',function(e){
            if(!$(this).val()) {
                var d = new Date();
                var m = d.getMonth() + 1;
                if(m < 10)
                    m = '0'+m;
                $(this).val(d.getFullYear()+'-'+m+'-'+d.getDate());
            }
            if(e.keyCode == 13) {
                $(this).datepicker('hide');
                $('[name=account]').focus();
            }
            if(e.keyCode > 36 && e.keyCode < 41){
                theKeyup(e,this);
            }
        });
        $('[name=debit],[name=credit]')
            .focus(function(){
                val = $(this).val();
                $(this).val(val.replace(/,/g,'')).select();
            })
            .calculator({
                showOn:'button',
                //buttonImageOnly:true,
                buttonImage:'/storage/images/calculator-icon-1.png',
                layout:['','_1_2_3_+','_4_5_6_-','_7_8_9_*','_0_._=_/',$.calculator.USE+$.calculator.ERASE], 
                useThemeRoller: true
            }).keyup(function(e){
                if(e.keyCode == 17)
                    $(this).calculator('hide');
            }).mousedown(function(e){
                if(e.which == 3)
                    $(this).calculator('hide');
            });
            $('.add-niel').click(function(){
                if($('.locked').html()) {
                    // no action
                } else {
                    var debit_val = $('[name=debit]').val().replace(/,/g,'');
                    if(!debit_val)
                        debit_val = 0;
                    var credit_val = $('[name=credit]').val().replace(/,/g,'');
                    if(!credit_val)
                        credit_val = 0;
                    $('.select2-selection__rendered').css('background-color','inherit');
                    $('input').css('background-color','inherit');
                    $.post('<?=route('g-journal.save')?>', {
                        _token: '{{csrf_token()}}',
                        description: $('[name=description]').val(),
                        date: $('[name=date]').val(),
                        account: $('[name=account]').val(),
                        debit: debit_val,
                        credit: credit_val,
                        segment: $('[name=segment]').val(),
                        job_project: $('[name=job_project]').val(),
                        flag: $('[name=flag]').prop('checked'),
                        note: $('[name=note]').val(),
                        location: $('[name=location]').val(),
                        split_selected: $('[name=split_selected]').val(),
                        trans_no: '{{$trans_no}}'
                    }).success((data)=>{
                        if(data) {
                            $('[name=split_selected]').val(false);
                            var d = new Date(data.date);
                            var month = (d.getMonth() + 1);
                            var day = d.getDate();
                            var debit = '';
                            var debit_num = 0;
                            var credit = '';
                            var credit_num = 0;
                            var amount = data.amount.replace(/,/g, "");
                            if(month < 10)
                                month = '0'+month;
                            if(day < 10)
                                day = '0'+day;
                            if(amount < 0) {
                                credit = Math.abs(amount);
                                if( credit > 0) {
                                    credit_num = Number(credit).toFixed(5);
                                    credit = parseFloat(credit_num).toFixed(2).toLocaleString('en');
                                } else {
                                    credit = '';
                                }
                            } else {
                                debit = amount;
                                if(debit > 0) {
                                    debit_num = Number(debit).toFixed(5);
                                    debit = parseFloat(debit_num).toFixed(2).toLocaleString('en');
                                } else {
                                    debit = '';
                                }
                            }
                            if(data.account)
                                accountVal = data.account;
                            else
                                accountVal = '';
                            if(data.segment)
                                segmentVal = data.segment;
                            else
                                segmentVal = '';
                            if(data.job_project)
                                job_projectVal = data.job_project;
                            else
                                job_projectVal = '';
                            html = '<tr id="gjournal-'+data.id+'" class="editables">';
                                html += '<td id="id" align="left">'+data.id+'</td>';
                                html += '<td id="transaction_line_no" align="left">'+data.total+'</td>';
                                html += '<td id="description" align="left">'+data.description+'</td>';
                                html += '<td id="date">'+d.getFullYear()+'-'+month+'-'+day+'</td>';
                                html += '<td id="account" align="left">'+accountVal+'</td>';
                                html += '<td id="debit" align="right">'+addCommas(debit)+'</td>';
                                html += '<td></td>';
                                html += '<td id="credit" align="right">'+addCommas(credit)+'</td>';
                                html += '<td></td>';
                                html += '<td id="segment">'+segmentVal+'</td>';
                                html += '<td id="job_project">'+job_projectVal+'</td>';
                                html += '<td data-selected="'+data.split_selected+'"></td>';
                                if(data.flag)
                                    flag = '<label class="container-check pull-left"><input type="checkbox" class="form-control pull-right" checked><span class="checkmark"></span></label>';
                                else
                                    flag = '<label class="container-check pull-left"><input type="checkbox" class="form-control pull-right"><span class="checkmark"></span></label>';
                                html += '<td id="flag">'+flag+'</td>';
                                if(data.note)
                                    note = "<span style='font-weight:bold; cursor:pointer; color:inherit;' class='glyphicon glyphicon-plus' tabindex='0' data-trigger='focus' data-toggle='popover' data-placement='top' title='Note' data-content=\""+data.note+"\"></span>";
                                else
                                    note = "<span style='font-weight:bold; cursor:pointer;' class='glyphicon glyphicon-minus'></span>";
                                html += '<td id="note">'+note+'</td>';
                                html += '<td id="action">';
                                    html += '<input type="hidden" value="'+amount+'">';
                                    html += '<span class="glyphicon glyphicon-edit" style="margin-right: 12px;"></span>';
                                    html += '<span class="glyphicon glyphicon-trash delete-niel"></span>';
                                html += '</td>';
                            html += '</tr>';
                            $('.from-database').append(html);
                            var total_debit = $('#total_debit');
                            var total_credit = $('#total_credit');
                            var total_debit_val = Number(total_debit.html().replace(/,/g, ""));
                            var total_credit_val = Number(total_credit.html().replace(/,/g, ""));
                            theTotalDebit = parseFloat((Number(theTotalDebit) + Number(debit_num))).toFixed(5);
                            theTotalCredit = parseFloat((Number(theTotalCredit) + Number(credit_num))).toFixed(5);
                            total_debit.html(addCommas(parseFloat((total_debit_val + Number(debit_num))).toFixed(2).toLocaleString('en')));
                            total_credit.html(addCommas(parseFloat((total_credit_val + Number(credit_num))).toFixed(2).toLocaleString('en')));
                            if(parseFloat(-1*(theTotalDebit - theTotalCredit)).toFixed(5) == Number(0).toFixed(5) && $('.split-r').length < 1)
                                $('#total_action').html('<a class="btn btn-primary" href="{{route('g-journal.post')}}">POST</a>');
                            else
                                $('#total_action').html('');
                            $('#total_balance').html('Out of Balance:&nbsp;&nbsp; '+(addCommas(parseFloat(-1*(theTotalDebit - theTotalCredit)).toFixed(5).toLocaleString('en'))));
                            $('.add-note-symbol').removeClass('glyphicon-plus').addClass('glyphicon-minus');
                            $('.popup-note').val('');
                            $('[name=note]').val('');
                            $('[name=account]').val('').change();
                            $('[name=flag]').prop('checked',false);
                            $('.new-entry').find('.split-r').attr('src','/img/split-b.png').removeClass('split-r');
                            $(this).parent().parent().find('[name=debit],[name=credit]').val('');
                            theEditables();
                            if(data.split_selected)
                                $('#gjournal-'+data.id).click();
                        }
                    }).error(function(error){
                        window.scrollTo(0, 0);
                        var hold = '<div class="alert spacer text-center">';
                        jQuery.each(error.responseJSON.errors, function(i,val) {
                            hold += '<h4><strong class="text-red">'+val+'</strong></h4>';
                            if(i == 'segment') {
                                i += '1';
                                if(!$('[name='+i+']').val()) {
                                    $('#select2-'+i+'-container').css('background-color','#f1b9b8');
                                    $('#select2-sel_segment-container').css('background-color','#f1b9b8');
                                }
                                else
                                    $('#select2-sel_segment-container').css('background-color','#f1b9b8');
                            }
                            else if(i == 'account')
                                $('#select2-sel_account-container').css('background-color','#f1b9b8');
                            else if(i == 'debit')
                                $('[name=debit],[name=credit]').css('background-color','#f1b9b8');
                            else
                                $('#select2-'+i+'-container').css('background-color','#f1b9b8');
                            $('[name='+i+']').css('background-color','#f1b9b8');
                        });
                        hold += '</div>';
                        $('.ajax-alert').html(hold).fadeTo(7000, 500).slideUp(1000, function(){
                            $(".alert").slideUp();
                        });
                    });
                }
            });
        /* end custom new */
        $('[name=location],[name=segment1],[name=segment],[name=account]').change(function(){
            $(this).next().find('.select2-selection__rendered').css('background-color','inherit');
        });
        $('[name=description],[name=date]').blur(function(){
            $(this).css('background-color','inherit');
        });
        $('.add-split-transaction').click(function(){
            $('[name=split_by],[name=split_amount],[name=split_item],[name=split_amount_by]').css('background-color','#fff');
            $.post('{{route('company-account-split-journal.save')}}',{
                t_no: '{{$trans_no}}',
                t_l_no: $('.locked #transaction_line_no').html(),
                t_sign: $('.locked #debit-edit input').val(),
                amount_to_split: $('[name=amount_to_split]').val(),
                split_by: $('[name=split_by]').val(),
                split_amount_by: $('[name=split_amount_by]').val(),
                sub_account_no: $('[name=split_item]').val(),
                split_amount: $('[name=split_amount]').val(),
                split_percent: $('[name=split_percent]').val(),
                note: $('[name=note_split]').val(),
                _token: $('[name=_token]').val(),
            }).success(function(data){
                $('[name=note_split]').val('');
                $('.popup-note-split').val('');
                $('.add-note-split-symbol').removeClass('glyphicon-plus').addClass('glyphicon-minus');
                $('[name=split_amount]').val('');
                $('[name=split_percent]').val('');
                splitTransactionTable($('.locked #transaction_line_no').html(),$('#account-edit select option:selected').val(),$('#action-edit input').val());
            }).error(function(error){
                if(error.responseJSON.errors.amount_to_split)
                    $('[name=split_amount]').css('background-color','#f1b9b8');
                if(error.responseJSON.errors.split_amount)
                    $('[name=split_amount]').css('background-color','#f1b9b8');
                if(error.responseJSON.errors.sub_account_no)
                    $('[name=split_item]').css('background-color','#f1b9b8');
                if(error.responseJSON.errors.split_by)
                    $('[name=split_by]').css('background-color','#f1b9b8');
                var hold = '<div class="alert spacer text-center">';
                jQuery.each(error.responseJSON.errors, (i,val)=> {
                    hold += '<h4><strong class="text-red">'+val+'</strong></h4>';                        
                });
                hold += '</div>';
                $('.ajax-alert-split').html(hold).fadeTo(7000, 500).slideUp(1000, function(){
                    $(".alert").slideUp();
                });
            });
        });
        var splitTransactionTable = function(t_l_no,acc_no,deb_cred) {
            t_l_no = $('.locked #transaction_line_no').html();
            $.get('/company-account-split-journals/split-account/{{$trans_no}}/'+t_l_no+'/'+acc_no,function(data){
                var _splitBy = '';
                var _splitABy = '';
                var holdTr = '';
                var splitAmount = 0;
                for(var a = 0; a < data.split_journals.length; a++) {
                    /*if(t_l_no == data.split_journals[a].trans_line_no)
                        trClass = '';
                    else*/
                        trClass = 'editables-split';
                    holdTr += '<tr class="'+trClass+'" id="gjournal-split-'+data.split_journals[a].id+'" style="color:#636b6f;">';
                        holdTr += '<td id="id">'+data.split_journals[a].id+'</td>';
                        holdTr += '<td>'+data.split_journals[a].line_no+'</td>';
                        if(data.split_journals[a]._job_project)
                            holdTr += '<td id="description" style="color:#636b6f; text-align:left;" data-sub-acc="'+data.split_journals[a]._job_project.id+'">'+data.split_journals[a]._job_project.name+'</td>';
                        else if(data.split_journals[a]._segment)
                            holdTr += '<td id="description" style="color:#636b6f; text-align:left;" data-sub-acc="'+data.split_journals[a]._segment.id+'">'+data.split_journals[a]._segment.name+'</td>';
                        else
                            holdTr += '<td id="description" style="color:#636b6f; text-align:left;" data-sub-acc="'+data.split_journals[a].account_split_item.id+'">'+data.split_journals[a].account_split_item.sub_account_no+' - '+data.split_journals[a].account_split_item.sub_account_name+'</td>';
                        if(data.split_journals[a].transaction_no) {
                            if(data.split_journals[a].original_amount_to_split)
                                amt_to_split = data.split_journals[a].original_amount_to_split.replace(/,/g, '');
                            else if(data.split_journals[a].parent)
                                amt_to_split = data.split_journals[a].parent.amount.replace(/,/g, '');
                            percentage = parseFloat((1 / (amt_to_split / data.split_journals[a].amount.replace(/,/g, '')))*100).toFixed(2).toString();
                            console.log(amt_to_split+'-'+data.split_journals[a].amount.replace(/,/g, ''));
                        } else {
                            percentage = parseFloat((1 / (data.split_journals[a].amount_to_split.replace(/,/g, '') / data.split_journals[a].split_amount.replace(/,/g, '')))*100).toFixed(2).toString();
                        }
                        holdTr += '<td id="percentage" style="padding-right:0; padding-left:0; color:#636b6f; text-align:center;">'+parseFloat(percentage)+'</td>';
                        if(data.split_journals[a].transaction_no)
                            debAm = data.split_journals[a].amount.replace(/,/g, '');
                        else
                            debAm = data.split_journals[a].split_amount;
                        if((data.split_journals[a].t_sign == 'debit' && debAm >= 0) || (data.split_journals[a].transaction_no && debAm >= 0)) {
                            if(data.split_journals[a].transaction_no)
                                holdTr += '<td id="debit" style="color:#636b6f; text-align:right;">'+addCommas(parseFloat(data.split_journals[a].amount.replace(/,/g, '')).toFixed(2))+'</td>';
                            else
                                holdTr += '<td id="debit" style="color:#636b6f; text-align:right;">'+addCommas(parseFloat(data.split_journals[a].split_amount.replace(/,/g, '')).toFixed(2))+'</td>';
                        }
                        else
                            holdTr += '<td></td>';
                        if(data.split_journals[a].transaction_no)
                            creAm = data.split_journals[a].amount.replace(/,/g, '');
                        else
                            creAm = 0 - data.split_journals[a].split_amount;
                        if((data.split_journals[a].t_sign == 'credit' && creAm < 0) || (data.split_journals[a].transaction_no && creAm < 0)) {
                            if(data.split_journals[a].transaction_no)
                                holdTr += '<td id="credit" style="color:#636b6f; text-align:right;">'+addCommas(parseFloat(Math.abs(data.split_journals[a].amount.replace(/,/g, ''))).toFixed(2))+'</td>';
                            else
                                holdTr += '<td id="credit" style="color:#636b6f; text-align:right;">'+addCommas(parseFloat(data.split_journals[a].split_amount.replace(/,/g, '')).toFixed(2))+'</td>';
                        }
                        else
                            holdTr += '<td></td>';

                        holdTr += '<td></td>';
                        holdTr += '<td id="note">';
                            if(data.split_journals[a].note)
                                holdTr += '<span style="font-weight:bold; cursor:pointer; color: #636b6f;" class="glyphicon glyphicon-plus" tabindex="0" data-trigger="focus" data-toggle="popover" data-placement="top" title="Split Note" data-content="'+data.split_journals[a].note+'"></span>';
                            else
                                holdTr += '<span style="font-weight:bold; cursor:pointer; color: #636b6f;" class="glyphicon glyphicon-minus" tabindex="0"></span>';
                        holdTr += '</td>';
                        holdTr += '<td id="action">';
                            if(data.split_journals[a].transaction_no)
                                holdTr += '<input type="hidden" value="'+data.split_journals[a].amount.replace(/,/g, '')+'">';
                            else
                                holdTr += '<input type="hidden" value="'+parseFloat(data.split_journals[a].split_amount).toFixed(5)+'">';
                            holdTr += '<span class="glyphicon glyphicon-edit" style="margin-right: 12px;"></span>';
                            holdTr += '<span class="glyphicon glyphicon-trash delete-split"></span>';
                        holdTr += '</td>';
                    holdTr += '</tr>';
                    if(data.split_journals[a].transaction_no)
                        splitAmount += Math.abs(parseFloat(data.split_journals[a].amount.replace(/,/g, '')));
                    else
                        splitAmount += parseFloat(data.split_journals[a].split_amount.replace(/,/g, ''));
                    if(data.split_journals[a]._job_project)
                        _splitBy = 3;
                    else if(data.split_journals[a]._segment)
                        _splitBy = 2;
                    else
                        _splitBy = data.split_journals[a].split_by;
                    _splitABy = data.split_journals[a].split_amount_by;
                }
                //$('[name=split_by]').val(_splitBy);
                if(_splitBy) {
                    $('[name=split_by]').val(_splitBy).change().attr('disabled',true);
                    if(data.split_journals[0].transaction_no) {
                        deb_cred = Math.abs(data.split_journals[0].original_amount_to_split.replace(/,/g, '')).toFixed(5);
                        $('.split-transaction-no-label').html('Split Transaction No:  '+data.split_journals[0].split_id_no);
                    }
                } else {
                    $('[name=split_by]').val('').change().attr('disabled',false);
                }
                $('#amount-to-split-label').val(deb_cred);

                $('.from-database-split').html(holdTr);
                if($('.locked #debit-edit input').val()){
                    if(data.split_selected == 2)
                        $('.locked #debit-edit').next().find('img').attr('src','/img/split-g.png').removeClass('split-r');
                    else
                        $('.locked #debit-edit').next().find('img').attr('src','/img/split-r.png').addClass('split-r');
                    $('#_total_split1').html(addCommas(parseFloat(splitAmount).toFixed(2)));
                    $('#_total_split').html('&nbsp;');
                } else {
                    if(data.split_selected == 2)
                        $('.locked #credit-edit').next().find('img').attr('src','/img/split-g.png').removeClass('split-r');
                    else
                        $('.locked #credit-edit').next().find('img').attr('src','/img/split-r.png').addClass('split-r');
                    $('#_total_split').html(addCommas(parseFloat(splitAmount).toFixed(2)));
                    $('#_total_split1').html('&nbsp;');
                }
                
                $('#total_balance_split').html(addCommas(Math.abs(parseFloat(deb_cred.replace(/,/g, '') - splitAmount).toFixed(5))));
                $('[data-toggle="popover"]').popover({trigger:'hover'});
                /*var holdOption = '<option value="">select</option>';
                for(var b = 0; b < data.split_items.length; b++) {
                    holdOption += '<option value="'+data.split_items[b].id+'">'+data.split_items[b].sub_account_name+'</option>';
                }
                $('[name=split_item]').html(holdOption);*/
                $('.delete-split').off().on('click',function(a){
                    a.stopImmediatePropagation();
                    $('.bs-delete-split-modal').modal();
                    $('.bs-delete-split-modal form').off().attr('action','{{route('company-account-split-journal.delete',[''])}}/'+$(this).parent().parent().find('#id').html()+'/'+$('[name=split_by]').val()).submit(function(e){
                        e.preventDefault();
                        $.get($(this).attr('action')).success(function(data){
                            if(data == 'Deleted') {
                                var acc_no = $('.locked #account-edit select option:selected').val();
                                var deb = $('.locked #action-edit input').val();
                                var t_l_no = $('.locked #transaction_line_no').html();
                                splitTransactionTable(t_l_no,acc_no,deb);
                                $('.bs-delete-split-modal').modal('hide');
                            } else {
                                console.log('?');
                            }
                        }).error(function(data){
                            console.log(data);
                        });
                    });
                });
                if($('#total_balance_split').html() == parseFloat(0).toFixed(5) || $('#total_balance_split').html() == 0) {
                    $('.new-entry-split').hide();
                    $('.locked #job_project-edit').next().attr('data-selected',2);
                    $('.locked .split-r').attr('src','/img/split-g.png').removeClass('split-r');
                }
                else {
                    $('.locked #job_project-edit').next().attr('data-selected',1);
                    $('.new-entry-split').show();
                }
                splitJS();
            });
        }
        $('.btn-split').click(function(){
            if($(this).parent().prev().find('input').val()) {
                $(this).addClass('selected');
                slitImg(this,'r');
            }
        });
        var slitImg = function(_this, color = 'b') {
            $(_this).parent().parent().find('.btn-split img').attr('src','/img/split-b.png').removeClass('split-r');
            if($('[name=split_selected').val() == 'true') {
                $('[name=split_selected]').val(false);
                $(_this).find('img').attr('src','/img/split-b.png').removeClass('split-r');
            }
            else {
                $('[name=split_selected]').val(true);
                $(_this).find('img').attr('src','/img/split-'+color+'.png').addClass('split-'+color);
            }
        }
        $('[name=split_by]').change(function(){
            var _splitB = $(this).val();
            var holdOption = '<option value="">select</option>';
            if(_splitB) {
                $.get('/company-account-split-journals/sub-account/'+_splitB+'/'+$('#account-edit select option:selected').val()).success((data)=>{
                    for(var b = 0; b < data.split_items.length; b++) {
                        if(_splitB == 1)
                            holdOption += '<option value="'+data.split_items[b].id+'">'+data.split_items[b].sub_account_name+'</option>';
                        else
                            holdOption += '<option value="'+data.split_items[b].id+'">'+data.split_items[b].name+'</option>';
                    }
                    $('[name=split_item]').html(holdOption);
                });
            } else {
                $('[name=split_item]').html(holdOption);
            }
        });
        var splitJS = function() {
            $('.editables-split').off().on('click',function(){
                if($(this).attr('class') == 'editables-split') {
                    if($('.locked-split').html()) {
                        $('.locked-split').find('.update-split').click();
                        setTimeout(()=>{
                            if(updateSplitError == false) {
                                updateSplitError = true;
                                $(this).click();
                            }
                        },2000);
                    } else {
                        $(this).attr('class','locked-split');
                        var subAccount = $(this).find('#description');
                        var percentage = $(this).find('#percentage');
                        var debit = $(this).find('#debit');
                        var credit = $(this).find('#credit');
                        var note = $(this).find('#note');
                        var action = $(this).find('#action');
                        var holdActionInput = action.find('input').val();

                        var subAccountElem = $('<select class="form-control" id="sel_account">').html($('[name=split_item]').html()).val(subAccount.data('sub-acc'));
                        //var subAccountElem = $('<input class="form-control">').val(subAccount.html());
                        subAccount.attr('id',subAccount.attr('id')+'-edit').html(subAccountElem);
                        var percentageElem = $('<input class="form-control" style="padding:7px;">').val(percentage.html());
                        percentage.attr('id',percentage.attr('id')+'-edit').html(percentageElem);
                        if(debit) {
                            var debitElem = $('<input class="form-control">').val(holdActionInput);
                            debit.attr('id',debit.attr('id')+'-edit').html(debitElem);
                        }
                        if(credit) {
                            var creditElem = $('<input class="form-control">').val(Math.abs(holdActionInput));
                            credit.attr('id',credit.attr('id')+'-edit').html(creditElem);
                        }

                        var noteElem = $('<textarea class="form-control">')
                            .css('visibility','hidden')
                            .css('width','0')
                            .css('position','absolute')
                            .val(note.find('span').data('content'));
                        var noteGlyph = $('<button class="glyphicon edit-note-split-symbol" data-toggle="modal" data-target=".bs-edit-note-split-modal" style="border:unset; background-color:transparent;">')
                            .css('color','inherit')
                            .css('font-weight','bold')
                            .click(function(){
                                $('[name=theid]').css('color','#000').val($(this).parent().parent().find('#id').html());
                                $('.popup-edit-note-split').val($(this).parent().find('textarea').val());
                            });
                        if(noteElem.val())
                            noteGlyph.addClass('glyphicon-plus');
                        else
                            noteGlyph.addClass('glyphicon-minus');
                        note.attr('id',note.attr('id')+'-edit').html(noteElem).append(noteGlyph);

                        var actionElem = $('<button class="glyphicon glyphicon-floppy-saved update-split" style="border:unset;"></button>')
                            .click(function(){
                                if($(this).parent().parent().find('#debit-edit > input').val())
                                    amount_post = $(this).parent().parent().find('#debit-edit > input').val();
                                else
                                    amount_post = $(this).parent().parent().find('#credit-edit > input').val();
                                $.post('<?=route('company-account-split-journal.edit')?>',{
                                    id: $(this).parent().parent().find('#id').html(),
                                    amount_to_split: $('[name=amount_to_split]').val(),
                                    sub_account_no: $(this).parent().parent().find('#description-edit > select').val(),
                                    split_amount: amount_post,
                                    split_percent: $(this).parent().parent().find('#percentage-edit > input').val(),
                                    note: $(this).parent().parent().find('#note-edit > textarea').val(),
                                    _token: $('[name=_token]').val(),
                                    splitby: $('[name=split_by]').val()
                                }).success((data)=>{
                                    if(data.transaction_no) {
                                        if(data.parent)
                                            orig_amt = data.parent.amount.replace(/,/g,'');
                                        else
                                            orig_amt = data.original_amount_to_split.replace(/,/g,'');
                                        if($('.locked #transaction_line_no').html() == data.trans_line_no) {
                                            if(data.amount.replace(/,/g,'') >= 0) {
                                                console.log('ok');
                                                $('.locked #debit-edit input').val(Math.abs(data.amount.replace(/,/g,'')).toFixed(5));
                                            } else {
                                                console.log('nasad');
                                                $('.locked #credit-edit input').val(Math.abs(data.amount.replace(/,/g,'')).toFixed(5));
                                            }
                                        }
                                        splitTransactionTable(data.trans_line_no,'',Math.abs(orig_amt).toFixed(5));
                                    } else {
                                        splitTransactionTable(data.t_l_no,'',data.amount_to_split);
                                    }
                                    updateSplitError = false;
                                }).error((error)=>{
                                    updateSplitError = true;
                                });
                            });
                        action.attr('id',action.attr('id')+'-edit').html(actionElem).append('<input type="hidden" value="'+Math.abs(holdActionInput.replace(/,/g,'')).toFixed(5)+'">');
                    }
                }
            });
        }
        $('.bs-split-transaction-modal').on('hidden.bs.modal',function(){
            $('.locked').find('#action-edit').append('<img style="width:50%" src="/assets/img/loading1.gif">');
            $('.locked').find('.update-niel').css('visibility','hidden').css('width',0).click();
        });
    });
</script>