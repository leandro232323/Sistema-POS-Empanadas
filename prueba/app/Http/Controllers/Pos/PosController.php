namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Cliente;

class PosController extends Controller
{
    public function index()
    {
        $productos = Producto::where('estado', true)->get();
        $clientes = Cliente::all();

        return view('pos.index', compact('productos', 'clientes'));
    }
}