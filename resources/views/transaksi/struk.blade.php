<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
     <style>
        {
            margin:0;
            padding:0;
            font-family: arial;
            font-size:6pt;
            color:#000;
        }
        body
        {
            width:100%;
            font-family: arial;
            font-size:6pt;
            margin:0;
            padding:0;
        }
         
        p
        {
            margin:0;
            padding:0;
            margin-left: 0px;
        }
         
        #wrapper
        {
            width:44mm;
            margin:0 0mm;
        }
        
        #main {
            float:left;
            width:0mm;
            background:#ffffff;
            padding:0mm;
        }
 
        #sidebar {
            float:right;
            width:0mm;
            background:#ffffff;
            padding:0mm;
        } 
         
        .page
        {
            height:200mm;
            width:44mm;
            page-break-after:always;
        }
 
        table
        {
            /** border-left: 1px solid #fff;
            border-top: 1px solid #fff; **/
            font-family: arial; 
            border-spacing:0;
            border-collapse: collapse; 
             
        }
         
        table td 
        {
            /**border-right: 1px solid #fff;
            border-bottom: 1px solid #fff;**/
            padding: 2mm;
            
        }
         
        table.heading
        {
            height:0mm;
            margin-bottom: 1px;
        }
         
        h1.heading
        {
            font-size:6pt;
            color:#000;
            font-weight:normal;
            font-style: italic;
            
            
        }
         
        h2.heading
        {
            font-size:6pt;
            color:#000;
            font-weight:normal;
        }
         
        hr
        {
            color:#ccc;
            background:#ccc;
        }
         
        #invoice_body
        {
            height: auto;
        }
         
        #invoice_body , #invoice_total
        {   
            width:100%;
        }
        #invoice_body table , #invoice_total table
        {
            width:100%;
            /** border-left: 1px solid #ccc;
            border-top: 1px solid #ccc; **/
     
            border-spacing:0;
            border-collapse: collapse; 
             
            margin-top:0mm;
        }
         
        #invoice_body table td , #invoice_total table td
        {
            text-align:center;
            font-size:8pt;
            /** border-right: 1px solid black;
            border-bottom: 1px solid black;**/
            padding:0 0;
            font-weight: normal;
        }
        
        #invoice_head table td
        {
            text-align:left;
            font-size:8pt;
            /** border-right: 1px solid black;
            border-bottom: 1px solid black;**/
            padding:0 0;
            font-weight: normal;
        }
         
        #invoice_body table td.mono  , #invoice_total table td.mono
        {
            text-align:right;
            padding-right:0mm;
            font-size:6pt;
            border: 1px solid white;
            font-weight: normal;
        }
         
        #footer
        {   
            width:44mm;
            margin:0 2mm;
            padding-bottom:1mm;
        }
        #footer table
        {
            width:100%;
            /** border-left: 1px solid #ccc;
            border-top: 1px solid #ccc; **/
             
            background:#eee;
             
            border-spacing:0;
            border-collapse: collapse; 
        }
        #footer table td
        {
            width:25%;
            text-align:center;
            font-size:8pt;
            /** border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;**/
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <div id="invoice_head">
            <table style="width:100%; border-spacing:0;">
                <tr>
                    <td>
                        <center>
                            <img src="{{ asset('assets/images/logo-dark.png') }}" width="40px" height="40px">
                        </center>
                    </td>
                </tr>
                {{-- <tr>
                    <td style="font-size: 6pt; font-weight: bold;"><!-- <img src="<?php // echo $_SESSION['gambar']; ?>" height="40" width="160" />--> <b>DJamal</b></td>
                    <td style="text-align:right;"> <p style="text-align:right; font-size: 14px; font-weight:bold; border-bottom: black; border-top: black; border-right: black; border-left: black; "></p></td>
                </tr>
                <tr>
                    <td colspan="2"> <p style="text-align:left; font-size: 6pt; font-weight: bold;">Alamat : Langensari indonesia </p></td>
                </tr>
                <tr>
                    <td><p style="text-align:left; font-size: 6pt; font-weight: bold; font-family: sans-serif;;">Telp : 082323625</p></td>            
                </tr> --}}
                <tr>
                    <td colspan="2"><img src="{{ asset('assets/images/logo-dark.png') }}" width="40px" height="40px"></td>
                </tr>
                <tr style="margin-top: 1px;">
                    <td><p style="text-align:left; font-size: 6pt; margin-top: 1px; font-weight: bold;"></p></td>
                    <td style="text-align:right;"><p style="font-size: 6pt; font-weight: bold;"><!--<img style="margin-top: 5px;" alt="<?php //$data['no_invoice'];?>" src="<?php //echo "barcode.php?size=15&text=DLV$_GET[id]"; ?>" /> </td>-->
                </tr>
                <tr>
                    <td style="border-bottom: 2px solid black;" colspan="2"></td>
                </tr>
            </table>
        </div>
    
        <table class="heading" style="width:100%;">
            <tr>
            <td> <center><p style="text-align:center; font-size: 6pt; font-weight:bold;">Struk Pembelian</p></center></td>
            </tr>
        </table>
        
        <table>
            <tr>
                <td><td><p style="text-align:left; font-size: 6pt; font-weight:bold;">No Trans : {{ $data->no_trans }} </p></td></td>
                <td><td><p style="text-align:left; font-size: 6pt; font-weight:bold;">Tanggal : {{ date('d M Y', strtotime($data->tanggal)) }} </p></td></td>
            </tr>
        </table>
            
        <div id="content">
            <div id="invoice_body">
                <table border="1">
                    <tr>
                        <td style="width:40%; font-size: 6pt;"><b>Pesanan</b></td>
                        <td style="width:25%; font-size: 6pt;"><b>Harga</b></td>
                        <td style="width:10%; font-size: 6pt;"><b>Jml</b></td>
                        <td style="width:25%; font-size: 6pt;"><b>Total</b></td>
                    </tr>
                
                    @foreach ($detail as $item)   
                        <tr border="0">
                            <td style="width:40%; text-align: left;" class="mono"><b>{{ $item->nama_pesanan }}</b></td>
                            <td style="width:25%;" class="mono"><b>Rp. {{ number_format($item->harga, 0, ',', '.') }}</b></td>
                            <td style="width:10%; text-align: center;" class="mono"><b>{{ $item->jumlah }}</b></td>
                            <td style="width:25%;" class="mono"><b>Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</b></td>
                        </tr>         
                    @endforeach
                </table>
            </div>
            
            <div id="invoice_total">
                <table border="1">
                    <tr>
                        <td colspan="3" style="width:10%; font-size: 6pt;" class="mono"><b><center>Total</b></center></td>  
                        <td colspan="2" style="width:15%; font-size: 6pt;" class="mono"><b>Rp. {{ number_format($data->total_bayar, 0, ',', '.') }}</b></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="width:10%; font-size: 6pt;" class="mono"><b><center>Cash</b></center></td>  
                        <td colspan="2" style="width:15%; font-size: 6pt;" class="mono"><b>Rp. {{ number_format($data->uang_kembali, 0, ',', '.') }}</b></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="width:10%; font-size: 6pt;" class="mono"><b><center>Kembalian</b></center></td>  
                        <td colspan="2" style="width:15%; font-size: 6pt;" class="mono"><b>Rp. {{ number_format($data->uang_kembali-$data->total_bayar, 0, ',', '.') }}</b></td>
                    </tr>
                </table>
            </div>
            
            <div id="invoice_total">
                <br />
                <table>
                    <tr>
                        <td style="text-align:left; font-size: 6pt; font-weight: bold;"><b>Terima kasih sudah berbelanja di "DJamal" </b></td>
                        <td style="text-align:left; font-size: 6pt; font-weight: bold;"></td>
                        <td colspan="2" style="text-align:center; font-size: 10px; font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <td style="text-align:left; font-size: 6pt; font-weight: normal;"><i></i></td>
                        <td style="text-align:left; font-size: 6pt; font-weight: bold;"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align:left; font-size: 6pt;"><b></b></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="text-align:center; font-size: 6pt; font-weight: bold;"></td>
                    </tr>
                </table>
                <hr />
            </div>
        </div>
        <br />
    </div>
</body>
<script>
    print()
</script>
</html>