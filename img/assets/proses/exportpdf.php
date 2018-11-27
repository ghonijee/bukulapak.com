<?php
require_once '../../control/connect.php';

        $kodeorder=$_GET['act'];
        $data1= mysqli_query($connection,"SELECT * FROM chekout where kd_order=$kodeorder");
        $order= mysqli_fetch_array($data1);
        $kodecust=$order['id'];
        $data2= mysqli_query($connection,"SELECT * FROM customer where id=$kodecust");
        $cust= mysqli_fetch_array($data2);
?>
<div id="nota">
    <table border=0 style=" outline: 2px solid lightblue; padding : 5px; ">
        <tr>
            <td>
                <table border=0 style=" outline:px solid black; width: 850px; font-family: arial; font-size: 15px;">
                    <img src="header.png" /><br />
                    <tr>
                    <tr style="font-weight: bolder;">
                        <td>Detail Order</td>
                        <td>Penerima</td>
                        <td>Pengirim</td>

                    </tr>
                    <?php
    echo "<tr>
        <td>Kode  : $order[kd_order]</td>
        <td>$cust[nama]</td>
        <td>BUKULAPAK</td>
        
    </tr>
    <tr>
        <td>Tgl   : $order[tanggal]</td>
        <td>$cust[no_hp]</td>
        <td>Free Shipping Bookstore</td>
        
    </tr>
    <tr>
        <td>Resi  : $order[noresi]</td>
        <td>$cust[alamat] <br> $cust[kodepos]</td>
        <td>Jl. Semarang No. 5 <br> Malang,Jawa Timur</td>
        
    </tr>
    <tr>
        <td>Total Belanja <br> Rp. $order[total]</td>
        <td></td>
        <td></td>
    </tr>";
?>
                </table>
                <img src="footer.png" /> <br /><br />
            </td>
        </tr>
    </table>
</div>
<div>
    <input type="button" value="PRINT" onclick="javascript:printDiv('nota')" />
</div>


<script>
    function printDiv(divID) {
        //Get the HTML of div
        var divElements = document.getElementById(divID).innerHTML;
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;

        //Reset the page's HTML with div's HTML only
        document.body.innerHTML = divElements;

        //Print Page
        window.print();

        //Restore orignal HTML
        document.body.innerHTML = oldPage;
    }
</script>