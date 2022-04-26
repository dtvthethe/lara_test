<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Test Api handle error to JSON
     * 2. Test log to log file and Slack
     *
     * @return \Illuminate\Http\Response
     */
    public function apiHandleError()
    {
        $categories = Category::whereNotNull('x')->get();

        return $categories;
    }

    /**
     * Test log to log file and Slack
     *
     * @return \Illuminate\Http\Response
     */
    public function apiLogErrorToLogFileAndSlack()
    {
        try {
            return 5 / 0;
        } catch (Exception $e) {
            Log::info($e->getMessage());
            // throw $e; -> ko cần vì Handle đã tự đc gọi ngay lúc / 0
        }
    }
}
