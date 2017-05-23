/**
 * Created by jtbai on 19/05/17.
 */

    $(document).ready(function() {
        $("#family_tel_1").focusout(function () {
            clean_phone_number();
            var tel = $("#family_tel_1");
            var $name_field = $("#name");
            var $family_name = $("#family_name");
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    $family_name.val(response['name']);
                    $name_field.autocomplete({
                        source: response['family_members'],
                        delay: 100,
                        classes: {
                            "ui-autocomplete": "highlight"
                        }
                    });
                    $family_name.select();
                }
            };
            xhttp.open("GET", "./api.php?ressource=family&tel1="+tel.val(), true);
            xhttp.send();
            format_phone_number();
        });
    });

