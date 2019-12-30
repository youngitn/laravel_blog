<?PHP

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\User;
class PostFormTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testRejectIfNotAuth()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/post/form')
                    ->assertPathIs('/login');
        });
    }
}
