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

    public function index() {
        return 'hello rookie';
    }

    public function tree() {
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
}
