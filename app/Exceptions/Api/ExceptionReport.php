<?php
/**
 * Created by PhpStorm.
 * User: mma
 * Date: 2018/8/17
 * Time: 下午12:06
 */

namespace App\Exceptions\Api;


use App\Http\Traits\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ExceptionReport
{
    use ApiResponse;

    /**
     * @var Exception
     */
    public $exception;
    /**
     * @var Request
     */
    public $request;

    /**
     * @var
     */
    protected $report;

    /**
     * ExceptionReport constructor.
     * @param Request $request
     * @param Exception $exception
     */
    function __construct(Request $request, \Exception $exception)
    {
        $this->request = $request;
        $this->exception = $exception;
    }

    /**
     * @var array
     */
    public $doReport = [
        AuthenticationException::class => ['未授权', 401],
        ModelNotFoundException::class => ['Not Found', 404],
        ValidationException::class => ['Failed Validate.', 200],
        AuthorizationException::class => ['This action is unauthorized.', 401],
    ];

    /**
     * @return bool
     */
    public function shouldReturn()
    {
        if (!($this->request->wantsJson() || $this->request->ajax())) {
            return false;
        }
        foreach (array_keys($this->doReport) as $report) {
            if ($this->exception instanceof $report) {
                $this->report = $report;
                return true;
            }
        }

        return false;

    }

    /**
     * @param Exception $e
     * @return static
     */
    public static function make(\Exception $e)
    {
        return new static(\request(), $e);
    }

    /**
     * @return mixed
     */
    public function report()
    {

        $message = $this->doReport[$this->report];
        return $this->failed($message[0], $message[1]);

    }


}