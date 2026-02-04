<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Hash;
class ProfileController extends Controller
{
    /**
     * Muestra el formulario de edición del perfil.
     */
    public function edit(Request $request, User $user = null): View|RedirectResponse
    {

        // Si no se pasa un usuario por URL, usamos el autenticado
        $user = $user ?? $request->user();

        // Verificación de seguridad: solo admin o el dueño del perfil
        if (!$request->user()->hasRole('admin') && $user->id !== $request->user()->id) {
            return Redirect::to('/');
        }

        return view('profile.edit', [
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    /**
     * Actualiza la información del perfil.
     */
    public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
    {

        // 1. Si $user es null (estás editando tu perfil), usamos el usuario de la sesión
        $model = $user ?? $request->user();

        // 2. Verificación de seguridad
        if (!$request->user()->hasRole('admin') && $model->id !== $request->user()->id) {
            return Redirect::to('/');
        }

        
        $model->fill($request->validated());

        if ($model->isDirty('email')) {
            $model->email_verified_at = null;
        }


        $model->save();

        // Lógica de Roles
        if ($request->user()->hasRole('admin') && $request->has('role')) {
            $model->syncRoles($request->role);
        }

        return Redirect::back()->with('status', 'profile-updated');
    }
    public function updatePasswordAdmin(Request $request, User $user)
    {
        $isSelf = auth()->id() === $user->id;

        $rules = [
            'password' => ['required', 'confirmed', 'min:8'],
        ];

        // Si el usuario se edita a sí mismo, exigimos la contraseña actual
        if ($isSelf) {
            $rules['current_password'] = ['required', 'current_password'];
        }

        $request->validate($rules);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', 'password-updated');
    }

    /**
     * Borra la cuenta propia.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Borra un usuario específico 
     */
    public function delete(Request $request, User $user = null): RedirectResponse
{
    // Si no viene usuario en la URL, asumimos que es el logueado
    $user = $user ?? $request->user();
    $isSelf = auth()->id() === $user->id;

    // Si es a sí mismo, pedir contraseña. Si es Admin, saltar.
    if ($isSelf) {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        
        Auth::logout(); // Solo deslogueamos si se borra a sí mismo
    } else {
        //Asegurarnos de que el que borra tiene permisos
        if (!auth()->user()->can('delete.users')) {
            abort(403, 'No tienes permiso para borrar otros usuarios.');
        }
    }

    $user->delete();

    // Si es si mismo invalida la sesion y regenera token
    if ($isSelf) {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::to('/');
    }

    return Redirect::to('/userlist')->with('status', 'user-deleted');
}
}