<?php
require('fpdf.php');

class PDF extends FPDF
{
	// En-t�te
	function Header()
	{
		// Logo
		$this->Image('logo.png',10,6,60);
		// Police Arial gras 15
		$this->SetFont('Times','B',13);
		$this->Cell(120);
		$this->SetTextColor(160);
		$this->Cell(10,10,'Annee universitaire 2015-2016',0,'C');
		// D�calage � droite
		$this->Ln();
		$this->SetFont('Times','B',15);
		$this->Cell(50);
		$this->SetTextColor(115,147,179);
		$this->Cell(50,30,'RELEVE DE NOTES ET RESULTATS',0,'C');
		// Saut de ligne
		$this->Ln(22);
	}

		// Pied de page
	function Footer()
	{
		// Positionnement à 1,5 cm du bas
		$this->SetY(-20);
		// Police Arial italique 8
		$this->SetFont('Arial','I',11);
		// Numéro de page
		$this->Cell(100);
		$this->Cell(0,7,'Fait a Antananarivo, le 12/09/2016',0,0,'C');
		$this->SetY(-14);
		$this->Cell(100);
		$this->Cell(0,7,'Le Recteur de l\'IT University ',0,0,'C');
	}

	function details(){
		$this->SetFont('Times','',12);
		$this->Cell(10,7,'Nom : ',0,1);
		$this->Cell(10,7,'Prenom(s) : ',0,1);
		$this->Cell(10,7,'Numero d\' inscription : ',0,1);
		$this->Cell(10,7,'Inscrit en : M1-Informatique',0,1);
		$this->Cell(10,7,'a obtenu les notes suivantes :',0,1);
		$this->Ln();
	}
	
	function Table($header, $data, $columnWidth, $aligns){

		$this->SetFont('Arial','B',11);
		for($t=0; $t<count($header); $t++){
			$this->Cell($columnWidth[$t],7.5,$header[$t],0,0,'C');
		}
		$this->Ln();

		$this->SetFont('Arial','',11);
		for($i=0; $i<count($data); $i++){
			if($i == count($data)-1){
				$this->SetFont('Arial','B',11);
			}
			for($j=0; $j<count($data[$i]); $j++){
				$this->Cell($columnWidth[$j],7.5,$data[$i][$j],0,0,$aligns[$j]);
			}
			$this->Ln();
		}

		$this->Ln();
	}
	
	function Resultat($data){
		$column = array(40,40,40);

		for($i=0; $i<count($data); $i++){
			for($j=0; $j<count($data[$i]); $j++){
				if($i == 0 && $j == 0){
					$this->SetFont('Arial','B',11);
				}else if($i == 3 && $j == 1){
					$this->SetFont('Arial','B',11);
				}else{
					$this->SetFont('Arial','',11);
				}
				$this->Cell($column[$j],7.5,$data[$i][$j],0,0,'L');
			}
			$this->Ln();
		}

		$this->Ln();
	}
}

$columnWidth = array(20,75,35,35,35);
$aligns = array('','R','C','C','C');

$header = array('UE','Intitule','Credits','Note/20','Resultat');

$data1 = array();
$data1[0] = array('INF401','Base de donnees d\' entreprise',6,11,'P');
$data1[1]=array('INF402','Structure de donnees avancees',3,11,'P');
$data1[2]=array('INF403','Programmation web avance',6,12.00,'AB');
$data1[3]=array('INF404','Interface graphique client lourd',3,8,'');
$data1[4]=array('INF405','Design Pattern',6,10.00,'P');
$data1[5]=array('INF406','Programmation distribuee et Web services',3,11.50,'P');
$data1[6]=array('INF407','Recherche operationnelle',3,8,'');
$data1[7]=array('','SEMESTRE 1',30,10.45,'P');

$data2 = array();
$data2[0] = array('INF408','Programmation par contrainte',4,13,'AB');
$data2[1]=array('INF409','Codage de l\'information',3,12.5,'AB');
$data2[2]=array('INF410','Architecture multi-tiers',4,10.5,'P');
$data2[3]=array('INF411','Progrmmation mobile',6,10,'P');
$data2[4]=array('INF412','Traitement de signal',4,6,'');
$data2[5]=array('INF413','ERP et Systeme d\'information',3,10,'P');
$data2[6]=array('INF414','Projet Informatique',6,14,'B');
$data2[7]=array('','SEMESTRE 2',30,10.98,'P');

$resultatData = array();
$resultatData[0] = array('Resultat General','Credits',60);
$resultatData[1] = array('','Moyenne Generale',10.72);
$resultatData[2] = array('','Mention','Passable');
$resultatData[3] = array('','ADMIS','');
$resultatData[4] = array('','Session','08/2016');

$pdf = new PDF();

//Details
$pdf->AddPage();
$pdf->details();
$pdf->Table($header,$data1,$columnWidth,$aligns);
$pdf->Table($header,$data2,$columnWidth,$aligns);
$pdf->Resultat($resultatData);
$pdf->Output();
?>
