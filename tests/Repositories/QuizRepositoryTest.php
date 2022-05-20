<?php namespace Tests\Repositories;

use App\Models\Quiz;
use App\Repositories\QuizRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class QuizRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var QuizRepository
     */
    protected $quizRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->quizRepo = \App::make(QuizRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_quiz()
    {
        $quiz = Quiz::factory()->make()->toArray();

        $createdQuiz = $this->quizRepo->create($quiz);

        $createdQuiz = $createdQuiz->toArray();
        $this->assertArrayHasKey('id', $createdQuiz);
        $this->assertNotNull($createdQuiz['id'], 'Created Quiz must have id specified');
        $this->assertNotNull(Quiz::find($createdQuiz['id']), 'Quiz with given id must be in DB');
        $this->assertModelData($quiz, $createdQuiz);
    }

    /**
     * @test read
     */
    public function test_read_quiz()
    {
        $quiz = Quiz::factory()->create();

        $dbQuiz = $this->quizRepo->find($quiz->id);

        $dbQuiz = $dbQuiz->toArray();
        $this->assertModelData($quiz->toArray(), $dbQuiz);
    }

    /**
     * @test update
     */
    public function test_update_quiz()
    {
        $quiz = Quiz::factory()->create();
        $fakeQuiz = Quiz::factory()->make()->toArray();

        $updatedQuiz = $this->quizRepo->update($fakeQuiz, $quiz->id);

        $this->assertModelData($fakeQuiz, $updatedQuiz->toArray());
        $dbQuiz = $this->quizRepo->find($quiz->id);
        $this->assertModelData($fakeQuiz, $dbQuiz->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_quiz()
    {
        $quiz = Quiz::factory()->create();

        $resp = $this->quizRepo->delete($quiz->id);

        $this->assertTrue($resp);
        $this->assertNull(Quiz::find($quiz->id), 'Quiz should not exist in DB');
    }
}
