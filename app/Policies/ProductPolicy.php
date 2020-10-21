<?php

namespace App\Policies;

use App\Product;
use App\User;
use http\Env\Request;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\User $user
     * @param \App\Product $product
     * @return mixed
     */
    public function view(User $user)
    {
        //
        return $user->checkPermission(config('permission.access.list-product'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->checkPermission(config('permission.access.add-product'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\User $user
     * @param \App\Product $product
     * @return mixed
     */
    public function update(User $user, Product $productEvaluate = null)
    {
        //Access từ url
        if ($productEvaluate == null) {
            $request = request();
            $productEvaluate = Product::find($request->id);
        }

        return ($user->checkPermission(config('permission.access.edit-product')) && $user->id == $productEvaluate->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\User $user
     * @param \App\Product $product
     * @return mixed
     */
    public function delete(User $user)
    {
        //
        return $user->checkPermission(config('permission.access.delete-product'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\User $user
     * @param \App\Product $product
     * @return mixed
     */
    public function restore(User $user, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\User $user
     * @param \App\Product $product
     * @return mixed
     */
    public function forceDelete(User $user, Product $product)
    {
        //
    }
}
