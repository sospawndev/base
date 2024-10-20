  <div class="card-body">
  		<table class="table">
        	<?php
			foreach($data as $key=>$val)
			{
			?>
            	<input type="hidden" name="<?=$key?>" value="<?=$val?>"/>
            <?php
			}
			?>
        	<tr>
            	<td>Inquiry reff</td>
                <td><?=$data->inquiry_reff?></td>
            </tr>
        	<tr>
            	<td>Payment reff</td>
                <td><?=$data->payment_reff?></td>
            </tr>
        	<tr>
            	<td>Partner reff</td>
                <td><?=$data->partner_reff?></td>
            </tr>
            <tr>
            	<td>Reference</td>
                <td><?=$data->reference?></td>
            </tr>
            <tr>
            	<td>Id Produk</td>
                <td><?=$data->id_produk?></td>
            </tr>
            <tr>
            	<td>Nama Produk</td>
                <td><?=$data->nama_produk?></td>
            </tr>
            <tr>
            	<td>Grup Produk</td>
                <td><?=$data->grup_produk?></td>
            </tr>
             <tr>
            	<td>Debitted</td>
                <td><?=number_format($data->debitted,0)?></td>
            </tr>
            <tr>
            	<td>Amount</td>
                <td><?=number_format($data->amount,0)?></td>
            </tr>
            <tr>
            	<td>Amount fee</td>
                <td><?=number_format($data->amountfee,0)?></td>
            </tr>
            <tr>
            	<td>Info1</td>
                <td><?=$data->info1?></td>
            </tr>
            <tr>
            	<td>Info2</td>
                <td><?=$data->info2?></td>
            </tr>
            <tr>
            	<td>Info3</td>
                <td><?=$data->info3?></td>
            </tr>
            <tr>
            	<td>info4</td>
                <td><?=$data->info4?></td>
            </tr>
            <tr>
            	<td>Status Trx</td>
                <td><?=$data->status_trx?></td>
            </tr>
            <tr>
            	<td>Status desc</td>
                <td><?=$data->status_desc?></td>
            </tr>
            <tr>
            	<td>Status Paid</td>
                <td><?=$data->status_paid?></td>
            </tr>
        </table>
  </div>