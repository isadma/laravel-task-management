<?php


namespace App\Traits;


use Illuminate\Http\RedirectResponse;

trait WebResponse
{
    public function created(): RedirectResponse
    {
        return redirect()->back()->with(["success", "Successfully created."]);
    }

    public function updated(): RedirectResponse
    {
        return redirect()->back()->with(["success", "Successfully updated."]);
    }

    public function deleted(): RedirectResponse
    {
        return redirect()->back()->with(["success", "Successfully deleted."]);
    }

    public function success(string $message): RedirectResponse
    {
        return redirect()->back()->with(["success", $message]);
    }

    public function error(string $message): RedirectResponse
    {
        return redirect()->back()->withErrors($message);
    }
}
