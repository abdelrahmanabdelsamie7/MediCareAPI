<?php
namespace App\Http\Controllers\API;
use App\Mail\AdminReplyMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['index', 'show', 'destroy','reply']);
    }
    public function index()
    {
        $contacts = Contact::all();
        return $this->sendSuccess('تم جلب بيانات الرسائل بنجاح', $contacts);
    }
    public function store(ContactRequest $request)
    {
        $contact = Contact::create($request->validated());
        return $this->sendSuccess('تم إرسال الرسالة بنجاح', $contact, 201);
    }
    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);
        return $this->sendSuccess('تم جلب تفاصيل الرسالة بنجاح', $contact);
    }
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return $this->sendSuccess('تم حذف الرسالة بنجاح');
    }
    public function reply(Request $request, string $id)
    {
        $contact = Contact::findOrFail($id);
        $validated = $request->validate([
            'reply' => 'required|string',
        ]);
        $contact->reply = $validated['reply'];
        $contact->save();
        Mail::to($contact->email)->send(new AdminReplyMail($contact));
        return $this->sendSuccess('تم إرسال الرد إلى البريد الإلكتروني بنجاح', $contact);
    }
}