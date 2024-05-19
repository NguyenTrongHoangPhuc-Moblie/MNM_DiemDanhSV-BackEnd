<?php
// app/Http/Controllers/SearchController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PhongHoc;

class SearchController extends Controller
{
    public function search($keyword, $table, $column)
    {
        // Kiểm tra tên bảng và cột hợp lệ
        if (!PhongHoc::hasTable($table) || !PhongHoc::hasColumn($table, $column)) {
            return response()->json(['error' => 'Invalid table or column name'], 400);
        }

        // Thực hiện truy vấn
        $results = DB::table($table)
                     ->where($column, 'like', '%' . $keyword . '%')
                     ->get();

        // Trả về kết quả dưới dạng JSON
        return response()->json($results);
    }
}
