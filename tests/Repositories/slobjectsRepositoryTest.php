<?php namespace Tests\Repositories;

use App\Models\slobjects;
use App\Repositories\slobjectsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class slobjectsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var slobjectsRepository
     */
    protected $slobjectsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->slobjectsRepo = \App::make(slobjectsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_slobjects()
    {
        $slobjects = slobjects::factory()->make()->toArray();

        $createdslobjects = $this->slobjectsRepo->create($slobjects);

        $createdslobjects = $createdslobjects->toArray();
        $this->assertArrayHasKey('id', $createdslobjects);
        $this->assertNotNull($createdslobjects['id'], 'Created slobjects must have id specified');
        $this->assertNotNull(slobjects::find($createdslobjects['id']), 'slobjects with given id must be in DB');
        $this->assertModelData($slobjects, $createdslobjects);
    }

    /**
     * @test read
     */
    public function test_read_slobjects()
    {
        $slobjects = slobjects::factory()->create();

        $dbslobjects = $this->slobjectsRepo->find($slobjects->id);

        $dbslobjects = $dbslobjects->toArray();
        $this->assertModelData($slobjects->toArray(), $dbslobjects);
    }

    /**
     * @test update
     */
    public function test_update_slobjects()
    {
        $slobjects = slobjects::factory()->create();
        $fakeslobjects = slobjects::factory()->make()->toArray();

        $updatedslobjects = $this->slobjectsRepo->update($fakeslobjects, $slobjects->id);

        $this->assertModelData($fakeslobjects, $updatedslobjects->toArray());
        $dbslobjects = $this->slobjectsRepo->find($slobjects->id);
        $this->assertModelData($fakeslobjects, $dbslobjects->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_slobjects()
    {
        $slobjects = slobjects::factory()->create();

        $resp = $this->slobjectsRepo->delete($slobjects->id);

        $this->assertTrue($resp);
        $this->assertNull(slobjects::find($slobjects->id), 'slobjects should not exist in DB');
    }
}
