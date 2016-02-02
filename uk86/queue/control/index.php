<?php
/**
 * 队列
*
*
*
*
* by Uk86 商城开发
*/
defined('InUk86') or exit('Access Invalid!');

class indexControl {

    public function queueOp() {
        if (ob_get_level()) ob_end_clean();

        $model_queue = Model('queue',BASE_PATH);

        $worker = new Uk86QueueServer();
        while (true) {
            $list_key = $worker->scan();
            if (!empty($list_key) && is_array($list_key)) {
                foreach ($list_key as $key) {
                    $content = $worker->pop($key);
                    if (empty($content)) continue;
                    $method = key($content);
                    $arg = current($content);
                    $model_queue->$method($arg);
                    echo date('Y-m-d H:i:s',time()).' '.$method."\n";
//                     $content['time'] = date('Y-m-d H:i:s',time());
//                     print_R($content);
//                     echo "\n";
                    flush();
                    ob_flush();
                }
            }
            sleep(1);
        }
    }
}