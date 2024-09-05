<!DOCTYPE html>
<html>
<head>
	<title>Bill Invoice</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/fav-icon.png'); ?>">
    <link href="<?= base_url('assets/vendor/fontawesome/css/all.min.css'); ?>" rel="stylesheet">
	<style type="text/css">
        @page {
		  size: A4 portrait;
		}
		@page {
		  size: A4 portrait;
		}

		@page :first {
			margin-top: 35pt;
		}
		@page :left {
			margin-right: 30pt;
		}
		@page :right {
			margin-left: 30pt;
		}
		@media print {
			footer {
				display: none;
				position: fixed;
				bottom: 0;
			}
			header {
				display: none;
				position: fixed;
				top: 0;
			}
            .fa-download{
                display: none;
            }
		}
		table, figure {
			page-break-inside: avoid;
		}
		
		* { 
			margin: 0;
			padding: 0;
		}
		body {
			width: 100%;
			display: block;
		}
		#page-wrap { 
			width: 800px;
			margin: 0 auto;
			page-break-before: always;
            border: 1px solid;
		}
		#header { 
			height: 15px;
			width: 100%;
/*			margin: 20px 0;*/
			background: #3b3b3e;
			text-align: center;
			color: white;
			font: bold 15px Helvetica, Sans-Serif;
			text-transform: uppercase;
			letter-spacing: 20px;
			padding: 8px 0px;
/*			page-break-before: always;*/
		}
		#shop-header { 
			height: 15px;
			width: 100%;
			margin: 20px 0;
			background: #eee ;
			text-align: center;
			color: black;
			font: bold 15px Helvetica, Sans-Serif;
			text-transform: uppercase;
			padding: 8px 0px;
			/* page-break-before: always; */
            margin-top: 0px;
            font-size: 17px;
		}
		#company-details {
			
		}
		#company-logo {
			margin: 10px;
			max-width: 140px;
			max-height: 140px;
			overflow: none;
/*			position: absolute;*/
		}
		#company-logo > img {
			width: 100%;
			height: 100%;
		}
		#logo-header {
/*			margin-left: 200px;*/
/*			position: absolute;*/
/*			max-width: 600px;*/
            margin-top: 47px;
		}
		.copy {
			font: bolder 15px Helvetica, Sans-Serif;
/*			width: 600px;*/
			text-transform: uppercase;
			text-align:right;
			resize: none;	
			padding: 5px;
		}

		#customer {
			overflow: hidden;
			margin-top: 10px;
            margin-bottom: 103px;
            margin-left: 19px;
		}
		#customer-data {
			position: absolute;
		}
		#customer-ship-to { 
			font-size: 13px;
			font-weight: bold;
			float: left; 
		}
		.customer-details {
			padding-top: 3px;
			font-size: 14px;
			font-weight: lighter;
			float: left; 	
		}
		#meta { 
			margin-left: 500px;
			margin-top: 1px;
			width: 300px;
			float: right;
		}

		#meta td {
			text-align: right;
		}
		#meta td.meta-head {
			text-align: left;
			background: #eee;
		}
		#meta td p {
			width: 100%;
			height: 20px;text-align: right;
		}

		#items {
			clear: both;
			width: 100%;
			margin: 30px 0 0 0;
			border: 1px solid black;
            text-align:center;
		}
		#items th {
			background: #eee;
		}
		
		#items th#cost { 
			width: 90px;
		}
		#items th#qty { 
			width: 90px;
		}
		#items th#tax { 
			width: 90px;
		}
		#items th#price { 
			width: 90px;
		}
		#items tr#item-row td {
			border: 0;
			vertical-align: top;
		}

		p { border: 0; font: 14px, Serif; overflow: hidden; resize: none; }
		table { border-collapse: collapse; }
		table td, table th { border: 1px solid black; padding: 5px; }

		#items p { width: 80px; height: 50px; }
		
		
		#items th.description p, #items td.item-name p { width: 100%; }
		#items td.total-line { border-right: 0; text-align: right; }
		
		#items td.total-value { border-left: 0; padding: 10px; }
		
		#items td.total-value p { height: 20px; background: none; }
		#items td.balance { background: #eee; }
		#items td.blank { border: 0; }

		#total-amount { margin: 20px 0 0 5px; }

		#shop-details{
            text-align : center;
        }
        #invoice {
			overflow: hidden;
			margin-top: 20px;
		}
        #customer-name{
            font-size: 16px; 
        }
        #customer-text{
            font-size: 16px;
            margin-top: 3px;    
        }
		hr{
            border: 1px solid black;
            margin-top:15px;
        }
        #shop-contact{
            margin-top:5px
        }
        #authorised
        {
            margin: 11px;
        }
	</style>
</head>
<body onload="window.print()">
    
	<div id="page-wrap">
		
		<div id="company-details">
			<div id="company-logo">
            	<img id="image" src="<?= IMGS_URL.$invoice[0]['logo']; ?>" alt="logo"/>
                
            </div>
          
		</div>
        
         <p id="header" >TAX INVOICE</p>
         <div id="logo-header">
            	<p class="copy">
                INVOICE NO.: <?=$invoice[0]['orderid']; ?>
            	</p>
            	<p class="copy">
                DATE: <?=$invoice[0]['order_date']; ?>
            	</p>
            </div>
		<div id="invoice">
           
            <div id="shop-details">
            	
            </div>
		</div>
       <hr>
       <?php 
            $address = $invoice[0]['random_address'].' '.$invoice[0]['apartment_name'].' '.$invoice[0]['pincode'].' '.$invoice[0]['city'].' '. $invoice[0]['state'] ;
            $name = $invoice[0]['fname'].' '.$invoice[0]['lname'];
            $mobile = $invoice[0]['mobile'].' , '.$invoice[0]['booking_contact'];
        
       
        ?>

		<div id="customer">
                <div id="customer-data">
                    <p>Bill To</p>
                    <p id="customer-name"><strong>Name - <?= $name ?></strong></p>
                    <p id="customer-text">Address - <?= $address; ?> <b>Landmark</b> - <?=$invoice[0]['direction']; ?></p>
                   
                    <p id="customer-text">Phone - <?= $mobile; ?></p>
                    <p id="customer-text">Email- <?= $invoice[0]['cust_email'] ?></p>
                </div>
               
		</div>
		<?php 
            $inclusive_tax = $invoice[0]['total_value'] - ($invoice[0]['total_value'] * (100/ (100 + $invoice[0]['tax_value'])));   
            $rate =($invoice[0]['total_value']/$invoice[0]['qty']) - $inclusive_tax;
        ?>
       
		<table id="items">
			<tr>
                <th id="item-name">S No</th>
				<th id="item-name">Particular(s)</th>
				<th id="qty">Qty</th>
				<th id="cost">MRP</th>
                <th id="cost">Discount</th>
				<th id="price">Price</th>
                <th id="price">Total</th>
			</tr>
            <?php
            $i=1;
            foreach($invoice as $row):
           
			?>
            <tr>
                <td><?=$i?></td>
                <td><?= $row['product_name']; ?></td>
                <td><?= $row['qty']; ?></td>
                <td>₹<?= $row['mrp']; ?></td>
                <td>₹<?= $row['mrp']-$row['price_per_unit']; ?>
                <td>₹<?= $row['price_per_unit']; ?>
                <td>₹<?= $row['total_price']; ?></td>
            </tr>
		  <?php
            $i=$i+1;
            endforeach;
            ?>
		</table>
       <?php
       
        if($invoice[0]['state'] != $invoice[0]['primary_state'])
        {
            $igst = $invoice[0]['order_tax'];
            $cgst = '0';
            $sgst = '0';
            $igst_per = $invoice[0]['tax_value'];
            $cgst_per = '0';
            $sgst_per = '0';
        }
        else
        {
            $igst = '0';
            $cgst = ($invoice[0]['order_tax'])/2;
            $sgst = ($invoice[0]['order_tax'])/2;
            $igst_per = '0';
            $cgst_per = $invoice[0]['tax_value']/2;
            $sgst_per = $invoice[0]['tax_value']/2;
        } 
        ?>
		<table id="items">
            <tr>
				<th id="item-name">Freight</th>
                <td>________________</td>
			</tr>
       
			<tr>
				<th id="item-name">Total</th>
                <td>₹<?= round(($invoice[0]['total_value']-$invoice[0]['order_tax']),2); ?></td>
			</tr>
			<tr>
				<th id="item-name">SGST </th>
                <td>₹ <?= round($sgst,2); ?></td>
			</tr>
			<tr>
				<th id="item-name">CGST </th>
                <td>₹ <?= round($cgst,2); ?></td>
			</tr>
			<tr>
				<th id="item-name">IGST</th>
                <td>₹ <?= round($igst,2); ?></td>
			</tr>
			<tr>
				<th id="grand-total">Grand Total</th>
                <th>₹<?= round($invoice[0]['total_value'],2); ?></th>
			</tr>
		</table>
        <div id="total-amount">
		  	<h3>Total Amount (INR - in words) : <?= number_to_word($invoice[0]['total_value']); ?></h3>
		</div>
        <hr>
        <div style="text-align: end">
            <h3 id="authorised">For My Books Deal</h3>
		  	<h4 id="authorised">Authorised Signatory</h4>
		</div>
          <div id="total-amount" style="text-align: center">
            <h4>Note</h4>  
            <p id="authorised">This is a computer generated invoice and does not require signature.</p>
		  	<p id="authorised">All disputes are subject to kanpur judiciary.</p>
		</div>
        <div style="text-align:center">
            <p><b>Add:.<?= $invoice[0]['address'].' , '.$invoice[0]['city_name'].' , '.$invoice[0]['state_name'].' , '.$invoice[0]['pin_code']; ?></b></p>
		</div>
	</div>
</body>
</html>
