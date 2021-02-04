
	$mpdf->AddPage();
	$mpdf->WriteHTML('
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>'.
		$vc1.
		'<br>'.
		$v21.
		'<br><br>'.
		$v3.
		''
		);
		
	$mpdf->AddPage();
	$mpdf->WriteHTML('
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>'.
		$vc2.
		'<br>'.
		$v22.
		$v3.
		$v4.
		''
		);		
		
	$mpdf->SetHTMLHeader('
	<div style="text-align: center; font-weight: bold;">
		<table width="750" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="10%" align="center">
					<img src="../imageneszet/logocabecera.jpg" />
				</td>
			</tr>
		</table>
		<table width="750">
			<tr>
				<td align="center">
					<span style="font-size:12px; font-weight:bold">
					"A&ntilde;o de la universalizaci&oacute;n de la Salud"
					</span>
				</td>
			</tr>
		</table>
	</div>'
	);
	
	$mpdf->AddPage();
	$mpdf->WriteHTML('
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>'.
		$a1_1.
		'<br>'.
		$a1_2.
		'<br>'.
		'<br>'.
		'<br>'.
		$a1_3.
		''
		);	
		
	$mpdf->AddPage();
	$mpdf->WriteHTML('
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>'.
		$a2_1.
		'<br>'.
		$a2_2.
		'<br>'.
		'<br>'.
		'<br>'.
		$a1_3.
		''
		);	
		
	$mpdf->AddPage();
	$mpdf->WriteHTML('
		<br>
		<br>
		<br>
		<br>
		<br>'.
		$a3_1.
		'<br>'.
		$a3_2.
		'<br>'.
		'<br>'.
		$a1_3.
		''
		);			
	