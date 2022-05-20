<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Quiz;

class QuizApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_quiz()
    {
        $quiz = Quiz::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/quizzes', $quiz
        );

        $this->assertApiResponse($quiz);
    }

    /**
     * @test
     */
    public function test_read_quiz()
    {
        $quiz = Quiz::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/quizzes/'.$quiz->id
        );

        $this->assertApiResponse($quiz->toArray());
    }

    /**
     * @test
     */
    public function test_update_quiz()
    {
        $quiz = Quiz::factory()->create();
        $editedQuiz = Quiz::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/quizzes/'.$quiz->id,
            $editedQuiz
        );

        $this->assertApiResponse($editedQuiz);
    }

    /**
     * @test
     */
    public function test_delete_quiz()
    {
        $quiz = Quiz::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/quizzes/'.$quiz->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/quizzes/'.$quiz->id
        );

        $this->response->assertStatus(404);
    }
}
