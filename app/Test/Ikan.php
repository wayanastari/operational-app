<?php

namespace App\Test;

class Ikan implements MahklukLaut{

    public function swim()
    {
        echo "Ikan bisa berenang dengan sirip";
    }

    public function dive()
    {
        echo "Ikan bisa menyelam";
    }

}