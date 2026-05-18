<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailSubscriber;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SubscribersController extends Controller
{
    public function index()
    {
        $subscribers = EmailSubscriber::latest('subscribed_at')->paginate(20);
        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function destroy(EmailSubscriber $subscriber)
    {
        $subscriber->delete();
        return redirect()->route('admin.subscribers.index')->with('success', 'Subscriber removed.');
    }

    public function export(): StreamedResponse
    {
        $subscribers = EmailSubscriber::all();

        return response()->streamDownload(function () use ($subscribers) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Email', 'Subscribed At', 'Active']);
            foreach ($subscribers as $s) {
                fputcsv($handle, [$s->id, $s->email, $s->subscribed_at, $s->is_active ? 'Yes' : 'No']);
            }
            fclose($handle);
        }, 'subscribers.csv', ['Content-Type' => 'text/csv']);
    }
}
