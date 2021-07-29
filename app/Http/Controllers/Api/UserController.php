<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BinaryTree\BinaryTree;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    private $binaryTree;

    private $esClient;

    private $redis;

    public function __construct() {
        $this->binaryTree = new BinaryTree();
        $this->esClient = ClientBuilder::create()->setHosts(['127.0.0.1'])->build();
        $this->redis = Redis::connection('default')->client();
    }

    public function index()
    {
        return 'hello rookie';
    }

    public function tree()
    {
        $rootArr = $this->binaryTree->create();
        $this->binaryTree->preOrder($rootArr['root2']);
        $result = $this->binaryTree->isSameTree($rootArr['root1'], $rootArr['root2']);
        var_dump($result);
    }

    public function elasticsearch() {
        print_r('es test');
    }

    public function getAliAttribute() {

        $this->redis->set('aaaaatest', 1111);
    }

    public function demo()
    {
        $fileUrl = 'https://zyb-infos-pri-1253445850.cos.ap-beijing.myqcloud.com/test-app/20210708192944732p1dp86.png?sign=q-sign-algorithm%3Dsha1%26q-ak%3DAKIDwsaIjuGLTMyNCqQF1ZOyI0TgbfW6EXO1%26q-sign-time%3D1627386820%3B1627473220%26q-key-time%3D1627386820%3B1627473220%26q-header-list%3D%26q-url-param-list%3Dresponse-content-disposition%26q-signature%3D7e2819aab58da2c4b6e718b4c732acf109f8a280&response-content-disposition=inline%3B%20filename%3DTEST-1.png';

        $info = pathinfo($fileUrl);
        $extension = $info['extension'];
        $outFileName = "zbhouGolang.{$extension}";


        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
//        $file = file_get_contents($fileUrl, false, stream_context_create($arrContextOptions));
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $fileUrl);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_HEADER,0);
        // 3. 执行并获取HTML文档内容
        $file = curl_exec($ch);
        if ($file) {
            $content = $file;
            $fileSize = strlen($content);
            header('Accept-Ranges: bytes');
            header('Accept-Length: ' . $fileSize);
            header('Content-Transfer-Encoding: binary');
            header('Content-type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . $outFileName);
            header('Content-Type: application/octet-stream; name=' . $outFileName);
            return $content;
        }

        return "文件：{$file}不存在";

    }
}
