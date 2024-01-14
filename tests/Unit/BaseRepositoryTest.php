<?php

namespace Tests\Unit;

use App\Constants\PaginatorPerPage;
use App\Models\BaseModel;
use App\Repositories\BaseRepository;
use App\Repositories\UsersRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use PHPUnit\Framework\TestCase;
use Illuminate\Database\Eloquent\Builder;


class BaseRepositoryTest extends TestCase
{
    use RefreshDatabase;
    private BaseRepository $baseRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->baseRepository = new UsersRepository();
    }

    public function test_paginatedList(): void
    {
        $data = ['your' => 'filter', 'data' => 'here'];
        $with = 'relatedModel';

        $queryBuilder = $this->getMockBuilder(Builder::class)->disableOriginalConstructor()->getMock();
        $model = $this->getMockBuilder(BaseModel::class)->disableOriginalConstructor()->getMock();
        $this->repository->expects( $this->once() )->method('query')->willReturn( $queryBuilder );
        $queryBuilder->expects($this->once())->method('filter')->with($data);
        $queryBuilder->expects($this->once())->method('with')->with($with);
        $queryBuilder->expects($this->once())->method('paginate')->with(PaginatorPerPage::PER_PAGE)->willReturn(new LengthAwarePaginator([], 0, PaginatorPerPage::PER_PAGE));
        $result = $this->yourRepository->paginatedList($data, $with);
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertTrue(true);
    }

    public function test_Create()
    {
        $data = ['field1' => 'value1', 'field2' => 'value2'];

        $model = $this->getMockBuilder(BaseModel::class)->disableOriginalConstructor()->getMock();
        $this->repository->expects($this->once())->method('getModel')->willReturn($model);
        $model->expects($this->once())->method('fill')->with($data);
        $model->expects($this->once())->method('save');
        $result = $this->repository->create($data);
        $this->assertInstanceOf(BaseModel::class, $result);
    }

    public function test_update()
    {

    }

    public function test_delete()
    {

    }

    public function test_findById()
    {

    }
}
