<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    // Method untuk proses checkout
    public function checkout()
    {
        $user_id = Auth::id(); // Mendapatkan ID pengguna yang sedang login
        $carts = Cart::where('user_id', $user_id)->get(); // Mendapatkan keranjang belanja pengguna

        if ($carts == null) { // Jika keranjang kosong, kembalikan ke halaman sebelumnya
            return Redirect::back();
        }

        // Buat pesanan baru
        $order = Order::create([
            'user_id' => $user_id
        ]);

        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id); // Dapatkan informasi produk berdasarkan ID produk di keranjang
            $product->update([
                'stock' => $product->stock - $cart->amount // Kurangi stok produk
            ]);

            // Buat transaksi untuk setiap produk dalam keranjang
            Transaction::create([
                'amount' => $cart->amount,
                'order_id' => $order->id,
                'product_id' => $cart->product_id
            ]);
            $cart->delete(); // Hapus item dari keranjang belanja setelah transaksi selesai
        }
        return redirect()->route('index_order')->with('success', 'Checkout berhasil!'); // Redirect ke halaman daftar pesanan dengan pesan sukses
    }

    // Method untuk menampilkan daftar pesanan
    public function index_order()
    {
        $user = Auth::user(); // Dapatkan informasi pengguna yang sedang login
        $is_admin = $user->is_admin; // Periksa apakah pengguna adalah admin

        if ($is_admin) {
            $orders = Order::all(); // Jika admin, tampilkan semua pesanan
        } else {
            $orders = Order::where('user_id', $user->id)->get(); // Jika bukan admin, tampilkan pesanan yang dimiliki oleh pengguna
        }
        return view('index_order', compact('orders')); // Tampilkan halaman daftar pesanan dengan data pesanan yang sesuai
    }

    // Method untuk menampilkan detail pesanan
    public function show_order(Order $order)
    {
        $user = Auth::user(); // Dapatkan informasi pengguna yang sedang login
        $is_admin = $user->is_admin; // Periksa apakah pengguna adalah admin

        // Jika pengguna adalah admin atau pemilik pesanan, tampilkan detail pesanan
        if ($is_admin || $order->user_id == $user->id) {
            return view('show_order', compact('order'));
        }
        return view('show_order', compact('order')); // Jika tidak, kembalikan detail pesanan tanpa perubahan
    }

    // Method untuk mengirim bukti pembayaran
    public function submit_payment_receipt(Order $order, Request $request)
    {
        $file = $request->file('payment_receipt'); // Dapatkan file bukti pembayaran dari request
        $path = time() . '_' . $order->id . '.' . $file->getClientOriginalExtension(); // Buat nama file unik berdasarkan waktu dan ID pesanan

        Storage::disk('local')->put('public/' . $path, file_get_contents($file)); // Simpan file bukti pembayaran ke penyimpanan lokal

        $order->update([
            'payment_receipt' => $path // Simpan nama file bukti pembayaran ke dalam pesanan
        ]);
        return Redirect::back(); // Redirect kembali ke halaman sebelumnya
    }

    // Method untuk mengonfirmasi pembayaran
    public function confirm_payment(Order $order)
    {
        $order->update([
            'is_paid' => true // Ubah status pesanan menjadi "sudah dibayar"
        ]);
        return Redirect::back(); // Redirect kembali ke halaman sebelumnya
    }

    // Method untuk menampilkan nota transaksi
    public function NotaTransaksi(Order $order)
    {
        return view('nota', compact('order')); // Tampilkan halaman nota transaksi dengan data pesanan
    }

    // Method untuk menolak pembayaran dan menghapus pesanan
    public function rejectPayment(Order $order)
    {
        // Lakukan validasi jika diperlukan (tidak ada dalam kode yang diberikan)

        $order->delete(); // Hapus pesanan dari database

        return Redirect::back(); // Redirect kembali ke halaman sebelumnya
    }
}
