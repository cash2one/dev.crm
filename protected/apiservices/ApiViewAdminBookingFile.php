<?php

class ApiViewAdminBookingFile extends EApiViewService {

    private $bookingId;
    private $files;
    private $type;

    public function __construct($bookingId, $values = null) {
        parent::__construct();
        $this->bookingId = $bookingId;
        $this->type = isset($values['report_type']) ? $values['report_type'] : 'mr';
        $this->files = array();
    }

    protected function createOutput() {
        if (is_null($this->output)) {
            $this->output = array(
                'status' => self::RESPONSE_OK,
                'errorCode' => 0,
                'errorMsg' => 'success',
                'results' => $this->results,
            );
        }
    }

    protected function loadData() {
        $this->loadBookingFile();
    }

    private function loadBookingFile() {
        $models = AdminBookingFile::model()->getAllByAttributes(array('admin_booking_id' => $this->bookingId, 'report_type' => $this->type));
        if (arrayNotEmpty($models)) {
            $this->setBookingFile($models);
        }
        $this->results->files = $this->files;
    }

    private function setBookingFile($models) {
        foreach ($models as $model) {
            $data = new stdClass();
            $data->id = $model->getId();
            $data->absFileUrl = $model->getAbsFileUrl();
            $data->absThumbnailUrl = $model->getAbsThumbnailUrl();
            $data->dateCreated = $model->date_created;
            $this->files[] = $data;
        }
    }

}
