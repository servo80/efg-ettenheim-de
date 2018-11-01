<?php

  namespace BB\custom\extension\efgettenheim\lib\classes {

    /**
     * Class rights
     * @package BB\custom\extension\efgettenheim\lib\classes
     */
    class agendaPdf {

      const OFFSET_X = 10;
      const OFFSET_Y = 20;
      const TABLE_OFFSET_Y = self::OFFSET_Y + 5;
      const LINE_HEIGHT = 5;
      const WIDTH_COLUMN1 = 40;
      const WIDTH_COLUMN2 = 150;
      const FONT_SIZE_HEADLINE = 16;
      const FONT_SIZE_TABLE = 10;


      /**
       * @var \BB\custom\extension\efgettenheim\access\object\service|null
       */
      private $serviceRow = null;

      /**
       * @var null
       */
      private $agendaRows = null;

      /**
       * @var \FPDF|null
       */
      private $pdf = null;

      /**
       * @param \BB\custom\extension\efgettenheim\access\object\service $serviceRow
       * @param \BB\custom\extension\efgettenheim\access\object\agenda[] $agendaRows
       */
      public function __construct($serviceRow, $agendaRows) {
        $this->requireFPdf();
        $this->pdf = new \FPDF();
        $this->loadFonts();
        $this->initSettings();
        $this->serviceRow = $serviceRow;
        $this->agendaRows = $agendaRows;
      }

      private function loadFonts() {
        $this->pdf->AddFont('Helvetica','','helvetica.php');
        $this->pdf->AddFont('Helvetica Bold','','helveticab.php');
      }

      /**
       * @return void
       */
      private function initSettings() {
        $this->pdf->SetAutoPageBreak(true);
        $this->pdf->AddPage();
      }

      /**
       * @return void
       */
      private function requireFPdf() {
        require('custom/extension/efgettenheim/lib/fpdf/fpdf.php');
        require('custom/extension/efgettenheim/lib/fpdf/makefont/makefont.php');
      }

      /**
       * @return string
       */
      private function getServiceSummaryText() {
        $serviceSummaryText =
          "\r\n".
          'Predigt: '.$this->getStaffFullName($this->serviceRow->servicePreacher)."\r\n".
          'Moderation: '.$this->getStaffFullName($this->serviceRow->serviceModerator)."\r\n".
          'Musikteam: '.$this->getStaffFullName($this->serviceRow->serviceWorshipLeader)."\r\n".
          'Technik: '.$this->getStaffFullName($this->serviceRow->serviceAudioEngineer)."\r\n".
          'Begrüßung: '.$this->getStaffFullName($this->serviceRow->serviceReceptionist)."\r\n".
          'Kindertreff (klein): '.$this->getStaffFullName($this->serviceRow->serviceSundaySchoolTeacherSmall)."\r\n".
          'Kindertreff (groß): '.$this->getStaffFullName($this->serviceRow->serviceSundaySchoolTeacherBig)."\r\n\r\n"
        ;
        return utf8_decode($serviceSummaryText);
      }

      /**
       *
       */
      private function buildHeadline() {
        $headlineText = 'Gottesdienstablauf am '.strftime('%d.%m.%Y', $this->serviceRow->serviceDate).' EFG Ettenheim';
        $this->pdf->SetFont('Helvetica','',self::FONT_SIZE_HEADLINE);
        $this->pdf->Text(self::OFFSET_X, self::OFFSET_Y, utf8_decode($headlineText));
        $this->pdf->SetXY(self::OFFSET_X, self::TABLE_OFFSET_Y);
      }

      /**
       *
       */
      private function buildRow($textColumn1, $textColumn2) {

        $xPosition = self::OFFSET_X + self::WIDTH_COLUMN1;
        $yPosition = $this->pdf->GetY();

        $this->pdf->SetFont('Helvetica','',self::FONT_SIZE_TABLE);

        $this->pdf->SetXY($xPosition, $yPosition);
        $this->pdf->MultiCell(
          self::WIDTH_COLUMN2,
          self::LINE_HEIGHT,
          $textColumn2,
          1
        );

        $xPosition = self::OFFSET_X;
        $secondColumnHeight = $this->pdf->GetY()-$yPosition;

        $this->pdf->SetFont('Helvetica Bold','',self::FONT_SIZE_TABLE);

        $this->pdf->SetXY($xPosition, $yPosition);
        $this->pdf->MultiCell(
          self::WIDTH_COLUMN1,
          $secondColumnHeight,
          $textColumn1,
          'LTB'
        );

      }

      /**
       *
       */
      public function build() {

        $this->buildHeadline();
        $this->buildRow(
          '',
          $this->getServiceSummaryText()
        );

        foreach($this->agendaRows as $agendaRow):
          $this->buildRow(
            utf8_decode($agendaRow->agendaResponsible),
            utf8_decode("\r\n".$agendaRow->agendaRemarks."\r\n\r\n")
          );
        endforeach;

      }

      /**
       *
       */
      public function output() {
        ob_clean();
        header('Content-type:application/pdf');
        $this->pdf->Output();
        exit;
      }

      /**
       * @param int $staffID
       * @return string
       */
      private function getStaffFullName($staffID) {

        $staffFactory = \BB\custom\extension\efgettenheim\access\factory\staff::get();
        $staffRow = $staffFactory->getRow($staffID);
        return $staffRow->staffFirstname.' '.$staffRow->staffLastname;
      }

    }

  }

?>