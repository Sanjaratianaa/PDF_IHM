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
		$this->SetFont('Arial','B',13);
		$this->Cell(120);
		$this->SetTextColor(160);
		$this->Cell(10,10,'Annee universitaire 2015-2016',0,'C');
		// D�calage � droite
		$this->Ln();
		$this->SetFont('Arial','B',15);
		$this->Cell(50);
		$this->SetTextColor(115,147,179);
		$this->Cell(50,30,'RELEVE DE NOTES ET RESULTATS',0,'C');
		// Saut de ligne
		$this->Ln(25);
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
	
	function Table($header, $data){

		for($t=0; $t<count($header); $t++){
			$this->Cell(40,7.5,$header[$t],0);
		}
		$this->Ln();

		$colWidth = 0;
		for($i=0; $i<count($data); $i++){
			for($j=0; $j<count($data[$i]); $j++){
				$this->Cell(40,7.5,$data[$i][$j],0);
			}
			$this->Ln();
		}

		$this->Ln();
	}
	
	function Resultat(){
		$this->SetFont('Times','',12);
		$this->Cell(10,7,'Resultat General: Credits: 			60',0,1);
		$this->Cell(10,7,'					Moyenne Generale: 	10,72',0,1);
		$this->Cell(10,7,'					Mention: 			Passable',0,1);
		$this->Cell(10,7,'					ADMIS',0,1);
		$this->Cell(10,7,'					Session:			08/2016',0,1);
	}
}

$html = '<p>Nom:</p><p>Prenom(s):</p><p>Ne le:</p><p>Numero d\' inscription:</p><p>Inscrit en: <strong> M1-Informatique </strong></p>
<p>a obtenu les notes suivantes:</p>';

$header = array('UE','Intitule','Credits','Note/20','Resultat');

$data = array();
$data[0] = array('INF401','Base de donnees d\' entreprise','6','11','P');
$data[1]=array('INF402','Structure de donnees avancees','3','11','P');
$data[2]=array('INF403','Programmation web avance','6','12,00','AB');
$data[3]=array('INF404','Interface graphique client lourd','3','8','');
$data[4]=array('INF405','Design Pattern','6','10,00','P');
$data[5]=array('INF406','Programmation distribuee et Web services','3','11,50','P');
$data[6]=array('INF407','Recherche operationnelle','3','8','');
$data[7]=array('','SEMESTRE 1','30','10,45','P');

$pdf = new PDF();

//Details
$pdf->AddPage();
$pdf->details();
$pdf->Table($header,$data);
$pdf->Table($header,$data);
$pdf->Resultat();
$pdf->Output();
?>
