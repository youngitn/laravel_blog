<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Post;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /**
     * @return void
     */
    //加入下面這段後 需要在測試方法中加入factory建立臨時測試資料
    use RefreshDatabase;
    public function testAllPost()
    {
       //建立測試資料
        $post = factory(Post::class)->create();
        //進入測試路由
        $response = $this->get('/posts/');
        //判斷回傳網頁狀態
        $response->assertStatus(200);
        //判斷回傳的資料內容
        $response->assertSee('All Posts:');
        $response->assertSee("Hello, I'm Louis."); //目前的文章
    }




    public function testInsertPost()
    {
        $post = factory(Post::class)->create();

        $this->assertDatabaseHas('posts', [
            'post_text' => "Hello, I'm Louis."
        ]);
    }

    /**
     * setUp() 是所謂的 Fixture 函式 (中文直翻："固定裝置")，用途是在每個測試函式執行前，都會先執行 setUp 的內容。
     * 將那些同樣的事前設定移到 setUp，就能減少在各個測試中重複的程式碼，其他類似的還有 tearDown() 在每個測試後執行，
     * 另外也可以只在整個測試類別執行一次的，有 setUpBeforeClass() 跟 tearDownAfterClass() 可以幫忙。
     *
     * @return void
     */
    protected function setUp(): void
    {
        //在 Laravel 中使用 fixture，需要呼叫，父類別的函式：parent::setUp()。
        parent::setUp();
        //有時 PHPUnit 預設並不會把所有錯誤訊息列出來，這樣寫測試時會不容易追蹤錯誤的源頭。
        $this->withoutExceptionHandling();
    }

    public function testInsertPostByGetRoute()
    {
        $text = "It's a new post.";

        $this->get("/posts/insert?post_text=$text");
        $response = $this->get('/posts/');

        $response->assertSee($text);
    }

}
