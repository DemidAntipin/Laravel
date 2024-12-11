namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Получение списка книг
    public function index()
    {
        $books = Book::with('author')->paginate(10); // Загружаем авторов
        return BookResource::collection($books);
    }

    // Создание новой книги
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:256',
            'cost' => 'required|numeric',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book = Book::create($request->all());
        return new BookResource($book);
    }

    // Получение конкретной книги
    public function show($id)
    {
        $book = Book::with('author')->findOrFail($id);
        return new BookResource($book);
    }

    // Обновление книги
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:256',
            'cost' => 'required|numeric',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->all());
        return new BookResource($book);
    }

    // Удаление книги
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(['message' => 'Книга удалена успешно.']);
    }
}

