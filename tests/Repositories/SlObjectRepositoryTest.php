<?php namespace Tests\Repositories;

use App\Models\SlObject;
use App\Repositories\SlObjectRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SlObjectRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SlObjectRepository
     */
    protected $slObjectRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->slObjectRepo = \App::make(SlObjectRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_sl_object()
    {
        $slObject = SlObject::factory()->make()->toArray();

        $createdSlObject = $this->slObjectRepo->create($slObject);

        $createdSlObject = $createdSlObject->toArray();
        $this->assertArrayHasKey('id', $createdSlObject);
        $this->assertNotNull($createdSlObject['id'], 'Created SlObject must have id specified');
        $this->assertNotNull(SlObject::find($createdSlObject['id']), 'SlObject with given id must be in DB');
        $this->assertModelData($slObject, $createdSlObject);
    }

    /**
     * @test read
     */
    public function test_read_sl_object()
    {
        $slObject = SlObject::factory()->create();

        $dbSlObject = $this->slObjectRepo->find($slObject->id);

        $dbSlObject = $dbSlObject->toArray();
        $this->assertModelData($slObject->toArray(), $dbSlObject);
    }

    /**
     * @test update
     */
    public function test_update_sl_object()
    {
        $slObject = SlObject::factory()->create();
        $fakeSlObject = SlObject::factory()->make()->toArray();

        $updatedSlObject = $this->slObjectRepo->update($fakeSlObject, $slObject->id);

        $this->assertModelData($fakeSlObject, $updatedSlObject->toArray());
        $dbSlObject = $this->slObjectRepo->find($slObject->id);
        $this->assertModelData($fakeSlObject, $dbSlObject->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_sl_object()
    {
        $slObject = SlObject::factory()->create();

        $resp = $this->slObjectRepo->delete($slObject->id);

        $this->assertTrue($resp);
        $this->assertNull(SlObject::find($slObject->id), 'SlObject should not exist in DB');
    }
}
