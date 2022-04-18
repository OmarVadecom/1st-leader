<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<script>
    var k = '@if(isset($items)){{count($items)}}@else{{0}}@endif';
      $(".add_products_btn").click(function() {
      var products = [];
      var parts = [];
      $.each($("input[name='product_id']:checked"), function() {
          if($(this).data('type')=='ES'||$(this).data('type')=='EA')
          {
              parts.push($(this).val());
          }
          else products.push($(this).val());
      });

      $.ajax({
          dataType: "json",
          url: "{{route('admin.ajax_add')}}",
          data: {
              'product_ids': products,
              'part_ids': parts,
          },
          success: function(data) {
              // $('#added_products_table').find("tr:gt(0)").remove();
              for (var i = 0; i < data.length; i++) {
                  var name='';
                  if(data[i].name!=null)
                          name = data[i].name;
                  $('#added_products_table tr:last').after('<tr> <input type="hidden" name="product[]" value="' + data[i].id + '">  <input type="hidden" name="product_code_type[]" value="' + data[i].code_type + '"> <td>' + data[i].code + '</td> <td> ' +name + '</td> <td><input type="number"  data-number="' + k + '" placeholder="الكميه" value="1" min="1"class="quantities form-control productquantity quantity' + k + '" name="quantity[]"></td> <td><input type="number"  data-number="' + k + '" step="any" placeholder="السعر" min="1" class="prices form-control productprice price' + k + '" name="price[]"> </td> <td class="totals totalfir' + k + '"></td> <td><input type="number" value="0" data-number="' + k + '" placeholder="الخصم %" min="0"class="form-control productdiscount discounts discount' + k + '"style="width:85%" name="discount[]"><span style="float: left; margin-top: -32px;">%</span> </td> <td class="totals totalsdisc totaldisc' + k + '"></td> <td><input type="number" value="15" data-number="' + k + '" placeholder="الضريبه" min="0"class="prices form-control productdreba dareba' + k + '" name="darebadis[]" style="width:85%" disabled> <input type="hidden" name="dareba[]" value="15" id=""><span style="float: left; margin-top: -32px;">%</span> </td> <td class="totals total' + k + '"> <input id="total_input" type="number" step="any" data-number="' + k + '" name="totals[]" class="totalinp' + k + ' form-control totalinp"> </td> <td><i class="fa fa-times clickremrow"></i> </td> </tr>');
                  $("#products_table").hide('slow');
                  $(".add_products_btn").hide('slow');
                  k++;
              }
          }
      });
  });

  $(document).on('keyup', '.productprice, .productquantity, .productdreba, .productdiscount', function() {
          num = $(this).data('number');
          price = $('.price' + num).val();
          quantity = $('.quantity' + num).val();
          dreba = $(".dareba" + num).val();
          discount = $('.discount' + num).val();
          total=$('.totalinp' + num).val();

           if(total != "" && price == ""){
             price=total;
             $('.price' + num).val(total);
            }
          totalfirst = price * quantity;
          discountvalue = totalfirst * (discount / 100);
          totalthird = totalfirst - discountvalue;

          drebavalue = totalthird * (dreba / 100);
          totalsecond = totalthird + drebavalue;
          console.log(totalsecond+' '+totalfirst+' '+drebavalue);

          $(".totalfir" + num).html(totalfirst);
          $(".totaldisc" + num).html(totalthird);
          $(".totalsec" + num).html(totalsecond);
          $(".totalinp"+num).val(totalsecond);
          var sumtotal = 0;
          $('.totalinp').each(function(){
                sumtotal += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
            });
            $(".totalmo").text(sumtotal);

            total=$(".totalmo").text();
            disc=$(".totdisc").val();
            n=disc * .13043;
            $(".totdiscinp").val(disc-n);
            $(".totalmoafter").text(total-disc);
            $(".totalmoinp").val(total-disc);

      })
      $(document).ready(function(){

            @if(isset($edit))
            var sumtotal = 0;
            var sumdisc = 0;

            $('.totalinp').each(function(){
                sumtotal += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
                $(".totalmo").text(sumtotal);
            });

            $('.totalsdisc').each(function(){
                sumdisc += parseFloat($(this).html());  // Or this.innerHTML, this.innerText
            });
            disc=$(".totdisc").val();
            totalbeforevat=sumdisc-disc;
            vat=totalbeforevat * {{getSettings('site_vat_value')}} / 100;
            totalaftervat=totalbeforevat+vat;

            $(".totalmoafter").text(totalaftervat.toFixed());
            $(".totalmoinp").val(totalaftervat.toFixed());
            @endif

            $(document).on('keyup','.totalinp', function() {
                num = $(this).data('number');
                total=$(this).val();
                $('.discount' + num).val(0);
                quantity = $('.quantity' + num).val();
                dreba = $(".dareba" + num).val();
                dr_val=parseFloat("1."+dreba);
                oldprice = (total/dr_val).toFixed(2);
                $(".totalfir" + num).html(oldprice);
                $(".totaldisc" + num).html(oldprice);
                if(quantity != ""){
                    unitprice=oldprice/quantity;
                    $('.price' + num).val(unitprice);
                }else{
                    $('.price' + num).val(oldprice);
                    $('.quantity' + num).val(1);
                }
                var sumtotal = 0;
                $('.totalinp').each(function(){
                    sumtotal += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
                });
                $(".totalmo").text(sumtotal);
                total=$(".totalmo").text();
                disc=$(".totdisc").val();
                n=disc * .13043;
                $(".totdiscinp").val(disc-n);
                $(".totalmoafter").text(total-disc);
                $(".totalmoinp").val(total-disc);
            })

            $(".totdisc").keyup(function(){
                total=$(".totalmo").text();
                disc=$(this).val();
                n=disc * .13043;
                $(".totdiscinp").val(disc-n);
                $(".totalmoafter").text(total-disc);
                $(".totalmoinp").val(total-disc);
            })
            $('.selectproduct').select2();

            $(document).on("click",".clickremrow",function() {
                $(this).parents("tr:first").remove();
                var sumtotal = 0;
                $('.totalinp').each(function(){
                    sumtotal += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
                });
                $(".totalmo").text(sumtotal);
                total=$(".totalmo").text();
                disc=$(".totdisc").val();
                n=disc * .13043;
                $(".totdiscinp").val(disc-n);
                $(".totalmoafter").text(total-disc);
                $(".totalmoinp").val(total-disc);
            })

            $("#submitprint").click(function(){
                $("#prstatus").val(1);
            })
            $("#lfm").hide();


           $('#add_main_spec').click(function(){
              $(".main_specs").append('<div class="col-md-7" style="margin-top: 10px"> <input type="text" name="main_spec[]" class="form-control main_spec" placeholder="الملاحظه"> </div> <div class="col-md-3" style="margin-top: 15px"> <input type="file" name="main_images[]"> </div> <div class="col-md-2"></div><br><br>');
              return false;
            })

           $('.removethis').click(function(){
            num=$(this).data('num');
            $(".file_num_"+num).val('');
            $(this).parent().remove();
            return false;
            })

        $('.stardel').click(function(){
          stars=$(this).data('id');
          $(".delegate").val(stars);
         for(i=1; i<=stars; i++){
         $(".delegate"+i).css('color','#ffc12b');
         }
        for(i=(stars+1); i<6; i++){
         $(".delegate"+i).css('color','#ccc');
         }
        })

       $('.stardelcl').click(function(){
       stars=$(this).data('id');
       $(".delegatecl").val(stars);
       for(i=1; i<=stars; i++){
        $(".delegatecl"+i).css('color','#ffc12b');
       }
       for(i=(stars+1); i<6; i++){
        $(".delegatecl"+i).css('color','#ccc');
       }
        })


        var count = 0;
        $("#addinputf").click(function() {
            count += 1;
            limit = $("#installmentnum").val();
            if (limit != '' && limit < count + 1) {
                return false;
            }
            $(".installment_dates").append('<div class="col-md-3"> <input type="date" name="installment_dates[]" class="form-control" placeholder="تاريخ دفعه" id=""> </div>');
            return false;
        })


        $("#inv_type").change(function() {
            if ($(this).val() == 2) {
                $(".installment").show('slow');
                $(".delayed").hide('slow');
            } else if($(this).val() == 0) {
                $(".installment").hide('slow');
                $(".delayed").show('slow');
            }else{
                $(".delayed").hide('slow');
                $(".installment").hide('slow');

            }
        })


        $(document).on('change', '#installment_type', function() {
            if ($(this).val() == 4) {
                $(".installment_dates").show('slow');
            } else {
                $(".installment_dates").hide('slow');
            }
        })

        $("#startpayment").keyup(function(){
        price=$("#total_price").val();
        value=$(this).val();
        $("#startpaymentvalue").val(price*value/100);
        if($("#installmentnum").val() != "" && $("#tax").val() != ""){
        startwithtax=$("#startpaymentvalue").val();

        totalprice=$("#total_price").val();
        number=$("#installmentnum").val();
        sub=totalprice-startwithtax;
        unitprice=sub/number;
        unitprice=Math.round((unitprice + Number.EPSILON) * 100) / 100
        $("#unitprice").val(unitprice);
        }
    })

          $("#startpaymentvalue").keyup(function(){
              price=$("#total_price").val();
              value=$(this).val();
              $("#startpayment").val(Math.round((value/price)*100));
          })



    $("#installmentnum").keyup(function(){
number=$(this).val();
price=$("#total_price").val();
price =price.replace(" ر.س.", "");
// start=$("#startwithtax").val();
start=$("#startpaymentvalue").val();
sub=price-start;
unitprice=sub/number;
unitprice=Math.round((unitprice + Number.EPSILON) * 100) / 100
$("#unitprice").val(unitprice);
})



$("#createtable").click(function(){
if($("#startpayment").val() == "" || $("#tax").val() == "" || $("#installmentnum").val() == "" || $("#installment_type").val()==""){
    $(".errortable").show('slow');
}else{
    $(".errortable").hide('slow');
    $(".showunitstable").show('slow');
    $(".paymentstable").html('')
    // start=$("#startwithtax").val();
    start=$("#startpaymentvalue").val();
    counts=$("#installmentnum").val();
    totalprice=$("#total_price").val();
    type=$("#installment_type").val();

    var date = new Date();
    var month = date.getMonth();
    var newDate = new Date(date.setMonth(date.getMonth()+1));
    sub=totalprice-start;
    unitprice=$("#unitprice").val();
    for(i=0; i<counts; i++){
    var date = new Date();
    var month = date.getMonth();
    ie=i+1;
    var newDate = new Date(date.setMonth(date.getMonth()+ie));
    startmonth=new Date(newDate.getFullYear(), newDate.getMonth(), 1);
    endmonth=new Date(newDate.getFullYear(), newDate.getMonth() + 1, 0);
    var start_date = startmonth.getDate();
    var start_month = startmonth.getMonth() + 1; //Months are zero based
    var start_year = startmonth.getFullYear();

    var end_date = endmonth.getDate();
    var end_month = endmonth.getMonth() + 1; //Months are zero based
    var end_year = endmonth.getFullYear();

    if(start_month<10){
        start_month='0'+start_month;
    }
    if(start_date < 10){
        start_date='0'+start_date;
    }
    if(end_date < 10){
    end_date='0'+end_date;
    }
    if(end_month < 10){
    end_month='0'+end_month;
    }

    startmonth=start_year + "-" + start_month + "-" + start_date;
    endmonth=end_year + "-" + end_month + "-" + end_date;
    if(type==1){
    datevalue=startmonth;
    }else if(type == 2){
    datevalue=endmonth;
    }else if(type == 3){
        datevalue='install';
    }else{
        datevalue='';
    }
    if(datevalue=='install'){
        $(".paymentstable").append('<tr> <td>'+ie+'</td> <td><input type="number" name="unit_price[]" value="'+unitprice+'" class="form-control"></td> <td><select data-num="'+ie+'" name="unit_type[]" class="form-control cashtype" id=""> <option value="1">شيك</option> <option value="0">كمبياله</option> </select></td> <td><select name="unit_bank[]" class="form-control unitbank'+ie+'" id=""> <option value="البنك الأهلي التجاري">البنك الأهلي التجاري</option> <option value="بنك ساب">بنك ساب</option> <option value="البنك السعودي الفرنسي">البنك السعودي الفرنسي</option> <option value="البنك الأول">البنك الأول</option> <option value="البنك السعودي للاستثمار">البنك السعودي للاستثمار</option> <option value="البنك العربي الوطني">البنك العربي الوطني</option> <option value="بنك البلاد">بنك البلاد</option> <option value="بنك الجزيرة">بنك الجزيرة</option> <option value="بنك الرياض">بنك الرياض</option> <option value="بنك سامبا">بنك سامبا</option> <option value="مصرف الراجحي">مصرف الراجحي</option> <option value="مصرف الإنماء">مصرف الإنماء</option> <option value="بنك الخليج الدولي">بنك الخليج الدولي</option> </select></td> <td><input  type="text" name="unit_bank_number[]" class="form-control unitbanknum'+ie+'" id=""> </td> <td>بعد شهر من التركيب</td> <td>بعد شهر من التركيب</td> <td><textarea name="unit_notes[]" class="form-control" rows="2"></textarea></td> </tr>');
    }else{
        $(".paymentstable").append('<tr> <td>'+ie+'</td> <td><input type="number" name="unit_price[]" value="'+unitprice+'" class="form-control"></td> <td><select  data-num="'+ie+'" name="unit_type[]" class="form-control cashtype" id="">  <option value="1">شيك</option> <option value="0">كمبياله</option> </select></td> <td><select  name="unit_bank[]" class="form-control unitbank'+ie+'" id=""> <option value="البنك الأهلي التجاري">البنك الأهلي التجاري</option> <option value="بنك ساب">بنك ساب</option> <option value="البنك السعودي الفرنسي">البنك السعودي الفرنسي</option> <option value="البنك الأول">البنك الأول</option> <option value="البنك السعودي للاستثمار">البنك السعودي للاستثمار</option> <option value="البنك العربي الوطني">البنك العربي الوطني</option> <option value="بنك البلاد">بنك البلاد</option> <option value="بنك الجزيرة">بنك الجزيرة</option> <option value="بنك الرياض">بنك الرياض</option> <option value="بنك سامبا">بنك سامبا</option> <option value="مصرف الراجحي">مصرف الراجحي</option> <option value="مصرف الإنماء">مصرف الإنماء</option> <option value="بنك الخليج الدولي">بنك الخليج الدولي</option> </select></td> <td><input type="text" name="unit_bank_number[]" class="form-control unitbanknum'+ie+'" id=""> </td> <td><input type="date" name="date_from[]" class="form-control" placeholder="من" value="'+datevalue+'" required></td> <td><input type="date" name="date_to[]" class="form-control" placeholder="الي" value="'+datevalue+'" required></td> <td><textarea name="unit_notes[]" class="form-control" rows="2"></textarea></td> </tr>');
    }
}
}
})


$(document).on('change', '.cashtype', function() {
            num=$(this).data('num');
            value=$(this).val();
            if(value == 1){
            $(".unitbank"+num).show('slow');
            $(".unitbanknum"+num).show('slow');
            }else{
            $(".unitbank"+num).hide('slow');
            $(".unitbanknum"+num).hide('slow');
            }


        });
        })


        function openTab(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    function addOfferDetail() {
        $("#offer-details").append('<div id="single-offer-detail" ><div class="col-md-1"> <button onclick="removeOfferDetail(this);" type="button" class="btn btn-danger" >-</button></div><div class="col-md-11"> <div class="form-group"> <input name="offer_details[]" class="form-control"></div></div></div>');
    }


    function removeOfferDetail(data) {
        $(data).parent().parent().remove();
    }


    function addClientDetail() {
        $("#client-details").append('<div id="single-client-detail" ><div class="col-md-1"> <button onclick="removeClientDetail(this);" type="button" class="btn btn-danger" >-</button></div><div class="col-md-11"> <div class="form-group"> <input name="offer_details[]" class="form-control"></div></div></div>');
    }


    function removeClientDetail(data) {
        $(data).parent().parent().remove();
    }
</script>
