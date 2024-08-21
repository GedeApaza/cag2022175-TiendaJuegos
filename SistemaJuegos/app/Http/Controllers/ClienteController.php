<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Cache\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;
use App\Models\Admin; 

class ClienteController extends Controller
{
      //todo: admin login form
      public function login_form()
      {
          return view('cliente.login-form');
      }
    /**
     * Handle an authentication attempt.
     */
    protected $limiter; // Definimos una propiedad para el RateLimiter.

    public function __construct(RateLimiter $limiter) // Constructor que recibe una instancia de RateLimiter.
    {
        $this->limiter = $limiter; // Asignamos la instancia del RateLimiter a la propiedad.
    }
    
    public function authenticate(Request $request)// Método para autenticar usuarios.
    {
    $maxAttempts = 3; // Número máximo de intentos fallidos permitidos.
    $decayMinutes = 2; // Minutos para bloquear la cuenta después de exceder el número máximo de intentos.

    $credentials = $request->validate([ // Validamos las credenciales recibidas.
    'email' => ['required', 'email'],
    'password' => ['required'],
    ]);

    // Verificamos si la cuenta está bloqueada debido a demasiados intentos fallidos.
    if ($this->limiter->tooManyAttempts($this->throttleKey($request), $maxAttempts)) {
    throw ValidationException::withMessages([
    'email' => 'Tu cuenta ha sido bloqueada. Por favor, inténtalo de nuevo en ' . $decayMinutes . ' minutos.',
    ]);
    }

    // Intentamos autenticar al usuario usando el guard personalizado.
    if (Auth::guard('cliente')->attempt($credentials)) {
    $request->session()->regenerate();

            // Restablecemos los intentos fallidos después de una autenticación exitosa.
            $this->limiter->clear($this->throttleKey($request));
    
            return redirect()->intended('dashboard');
        }
    
        // Registramos un intento fallido.
        $this->limiter->hit($this->throttleKey($request), $decayMinutes * 60);
    
        throw ValidationException::withMessages([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }
    
    protected function throttleKey(Request $request) // Método para generar la clave de bloqueo.
    {
        // La clave de bloqueo se compone del email y la IP del usuario.
        return mb_strtolower($request->input('email')) . '|' . $request->ip();
    }
}