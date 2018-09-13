<?php
namespace console\tests;

use yii\base\Model;

class TestActive extends Model
{
    public function isDaemonActive($pidfile) {
        if( is_file($pidfile) ) {
            $pid = file_get_contents($pidfile);
            //получаем статус процесса
            $status = $this->getDaemonStatus($pid);
            if($status['run']) {
                //демон уже запущен
//                consolemsg("daemon already running info=".$status['info']);
                return true;
            } else {
                //pid-файл есть, но процесса нет
//                consolemsg("there is no process with PID = ".$pid.", last termination was abnormal...");
//                consolemsg("try to unlink PID file...");
                if(!unlink($pidfile)) {
//                    consolemsg("ERROR");
                    //не могу уничтожить pid-файл. ошибка
                    exit(-1);
                }
//                consolemsg("OK");
            }
        }
        return false;
    }

    public function getDaemonStatus($pid) {
        $result = ['run'=>false];
        $output = null;
        exec("ps -aux -p ".$pid, $output);

        if(count($output)>1){//Если в результате выполнения больше одной строки то процесс есть! т.к. первая строка это заголовок, а вторая уже процесс
            $result['run'] = true;
            $result['info'] = $output[1];//строка с информацией о процессе
        }
        return $result;
    }
}