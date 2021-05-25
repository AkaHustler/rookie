<?php

namespace App\Console\Commands;

use App\Models\BinaryTree\BinaryTree;
use App\Models\BinaryTree\LeetCodeTree;
use Illuminate\Console\Command;

/**
 * Class LeetCode
 * @package App\Console\Commands
 */
class LeetCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'LeetCode:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'LeetCode:run';

    private $binaryTree;

    private $leetCodeTree;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->binaryTree = new BinaryTree();
        $this->leetCodeTree = new LeetCodeTree();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $head = $this->binaryTree->create();
        $depth = $this->leetCodeTree->maxDepth($head);
        echo sprintf("二叉树最大深度为:%s", $depth);
        return 0;
    }
}
