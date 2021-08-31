<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Subjects;
use App\Classrooms;
use App\Batches;
use App\OnlineExams;
use App\Questions;
use App\OnlineExamsQuestions;
use App\Questions_Options;
use App\OnlineExamResults;
use App\OnlineExamAnswers;
use App\Http\Requests\StoreOnlineExamsRequest;
use App\Classroom_Teachers as ClassroomTeachers;

class OnlineExamsController extends Controller
{
    // This function gets all data required for the index page
    public function index()
    {
        if (Auth::user()->role_id == 1 ) {
            $exams = OnlineExams::all();
            return view('online-exams.index', compact('exams'));
        } elseif (Auth::user()->role_id == 7) {
            $exams = OnlineExams::where([['published', '=', '1'], ['classroom_id', Auth::user()->student_classroom_id]])->get();
            return view('online-exams.index', compact('exams'));
        } elseif (Auth::user()->role_id == 6) {
            $exams = OnlineExams::where('teacher_id', Auth::id())->get();
            return view('online-exams.index', compact('exams'));
        } else {
            return redirect()->back()->with('errors', trans('controller.online-exams.view_error'));
        }
    }

    // This function gets all the data required for the create page and returns to it
    public function create()
    {
        if (Auth::user()->role_id == 1 ) {
            $subjects = Subjects::all()->pluck('title', 'id');
            $classrooms = Classrooms::all()->pluck('title', 'id');
            $questions = Questions::get()->pluck('question_text', 'id');
            $visibility = ['0' => 'Draft(Show only to Admin and Teachers)', '1' => 'Publish(Show to Everyone)'];
            return view('online-exams.create', compact('subjects', 'classrooms', 'teacher_id', 'questions', 'visibility'));
        } elseif (Auth::user()->role_id == 6) {
            $classroom_pluck = ClassroomTeachers::where('teacher_id', Auth::id())->pluck('classroom_id');
            $subject_pluck = ClassroomTeachers::where('teacher_id', Auth::id())->pluck('subject_id');
            $classrooms = Classrooms::whereIn('id', $classroom_pluck)->pluck('title', 'id');
            $subjects = Subjects::whereIn('id', $subject_pluck)->pluck('title', 'id');
            $questions = Questions::where('teacher_id', Auth::id())->pluck('question_text', 'id');
            $visibility = ['0' => 'Draft(Show only to Admin and Teachers)', '1' => 'Publish(Show to Everyone)'];
            return view('online-exams.create', compact('subjects', 'classrooms', 'teacher_id', 'questions', 'visibility'));
        } else {
            return redirect()->back()->with('errors', trans('controller.online-exams.create_error'));
        }
    }

    public function store(StoreOnlineExamsRequest $request)
    {
        if (Auth::user()->role_id == 1 ) {
            $exams = new OnlineExams;
            $exams->title = $request->title;
            $exams->description = $request->description;
            $exams->classroom_id = $request->classroom_id;
            $exams->batch_id = $request->batch_id;
            $exams->subject_id = $request->subject_id;
            $exams->published = $request->published;
            $exams->teacher_id = Auth::id();
            $exams->added_by = Auth::id();
            $exams->save();
            $question_id = $request->question_id;
            foreach ($question_id as $index => $question_id) {
                OnlineExamsQuestions::create([
                    'online_exam_id'  => $exams->id,
                    'question_id'     => $question_id,
                ]);
            }
            return redirect()->route('online-exams.index')->with('success', trans('controller.online-exams.create_success'));
        } elseif (Auth::user()->role_id == 6) {
            $pluck_subject_id = ClassroomTeachers::where('classroom_id', $request->classroom_id)->pluck('subject_id')->toArray();
            $pluck_teacher_id = ClassroomTeachers::where('classroom_id', $request->classroom_id)->pluck('teacher_id')->toArray();
            if (in_array($request->subject_id, $pluck_subject_id) && in_array(Auth::id(), $pluck_teacher_id)) {
                $exams = new OnlineExams;
                $exams->title = $request->title;
                $exams->description = $request->description;
                $exams->classroom_id = $request->classroom_id;
            $exams->batch_id = $request->batch_id;
                $exams->subject_id = $request->subject_id;
                $exams->published = $request->published;
                $exams->teacher_id = Auth::id();
                $exams->added_by = Auth::id();
                $exams->save();
                $question_id = $request->question_id;
                foreach ($question_id as $index => $question_id) {
                    OnlineExamsQuestions::create([
                        'online_exam_id'  => $exams->id,
                        'question_id'     => $question_id,
                    ]);
                }
                return redirect()->route('online-exams.index')->with('success', trans('controller.online-exams.create_success'));
            } else {
                return redirect()->back()->with('warning', trans('controller.online-exams.selection_warning'));
            }
        } else {
            return redirect()->back()->with('errors', trans('controller.online-exams.create_error'));
        }
    }

    // This function gets the data required for the edit page
    public function edit($id)
    {
        $teacher_id = OnlineExams::where('id', $id)->pluck('teacher_id')->first();
        if (Auth::user()->role_id == 1  || (Auth::user()->role_id == 6 && Auth::id() == $teacher_id)) {
            $exams = OnlineExams::findOrFail($id);
            $subjects = Subjects::all()->pluck('title', 'id');
            $classrooms = Classrooms::all()->pluck('title', 'id');
            $batches = Batches::all()->pluck('title', 'id');
            $visibility = ['0' => 'Draft(Show only to Admin and Teachers)', '1' => 'Publish(Show to Everyone)'];
            return view('online-exams.edit', compact('exams', 'subjects', 'classrooms', 'visibility'));
        } else {
            return redirect()->back()->with('errors', trans('controller.online-exams.delete_error'));
        }
    }

    // This function updates the data in the database
    public function update(Request $request, $id)
    {
        $teacher_id = OnlineExams::where('id', $id)->pluck('teacher_id')->first();
        if (Auth::user()->role_id == 1 ) {
            $exams = OnlineExams::findOrFail($id);
            $exams->title = $request->title;
            $exams->description = $request->description;
            $exams->classroom_id = $request->classroom_id;
            $exams->subject_id = $request->subject_id;
            $exams->published = $request->published;
            $exams->updated_by = Auth::id();
            $exams->update();
            return redirect()->route('online-exams.index')->with('success', trans('controller.online-exams.edit_success'));
        } elseif (Auth::user()->role_id == 6 && Auth::id() == $teacher_id) {
            $pluck_subject_id = ClassroomTeachers::where('classroom_id', $request->classroom_id)->pluck('subject_id')->toArray();
            $pluck_teacher_id = ClassroomTeachers::where('classroom_id', $request->classroom_id)->pluck('teacher_id')->toArray();
            if (in_array($request->subject_id, $pluck_subject_id) && in_array(Auth::id(), $pluck_teacher_id)) {
                $exams = OnlineExams::findOrFail($id);
                $exams->title = $request->title;
                $exams->description = $request->description;
                $exams->classroom_id = $request->classroom_id;
                $exams->subject_id = $request->subject_id;
                $exams->published = $request->published;
                $exams->updated_by = Auth::id();
                $exams->update();
                return redirect()->route('online-exams.index')->with('success', trans('controller.online-exams.edit_success'));
            } else {
                return redirect()->back()->with('warning', trans('controller.online-exams.selection_warning'));
            }
        } else {
            return redirect()->back()->with('errors', trans('controller.online-exams.edit_error'));
        }
    }

    // This function sends all the questions to take_exams page where the student sees it.
    public function take_exams($id)
    {
        $exam_classroom_id = OnlineExams::where('id', $id)->pluck('classroom_id')->first();
        if ((Auth::user()->role_id == 7) && (Auth::user()->student_classroom_id == $exam_classroom_id)) {
            $exams = OnlineExams::findOrFail($id);
            $questions = OnlineExamsQuestions::where('online_exam_id', $id)->get();
            //dd($questions);
            $online_exam_id = $id;
            foreach ($questions as $question) {
                $question->options = Questions_Options::where('question_id', $question->question_id)->inRandomOrder()->get();
            }
            return view('online-exams.take_exams', compact('exams', 'questions', 'online_exam_id'));
        } else {
            return redirect()->back()->with('errors', trans('controller.online-exams.create_error'));
        }
    }

    // This function stores the submissions of the students
    public function store_submissions(Request $request, $online_exam_id)
    {
        $exam_classroom_id = OnlineExams::where('id', $online_exam_id)->pluck('classroom_id')->first();
        if ((Auth::user()->role_id == 7) && (Auth::user()->student_classroom_id == $exam_classroom_id)) {
            $result = 0;
            $exam = OnlineExamResults::create([
                'online_exam_id' => $online_exam_id,
                'student_id' => Auth::id(),
                'result'  => $result,
            ]);
            foreach ($request->input('questions', []) as $key => $question) {
                $status = 0;
                if ($request->input('answers.' . $question) != null && Questions_Options::find($request->input('answers.' . $question))->correct) {
                    $status = 1;
                    $result++;
                }
                OnlineExamAnswers::create([
                    'student_id'     => Auth::id(),
                    'online_exam_id' => $online_exam_id,
                    'question_id'    => $question,
                    'option_id'      => $request->input('answers.' . $question),
                    'correct'        => $status,
                ]);
            }
            $exam->update(['result' => $result]);
            return redirect()->route('results.show', [$exam->id]);
        } else {
            return redirect()->back()->with('errors', trans('controller.online-exams.create_error'));
        }
    }

    public function questions($online_exam_id)
    {
        $teacher_id = OnlineExams::where('id', $online_exam_id)->pluck('teacher_id')->first();
        if (Auth::user()->role_id == 1  || (Auth::user()->role_id == 6 && Auth::id() == $teacher_id)) {
            $questions = OnlineExamsQuestions::where('online_exam_id', $online_exam_id)->get();
            return view('online-exams.questions', compact('questions', 'online_exam_id'));
        } else {
            return redirect()->back()->with('errors', trans('controller.online-exams.view_error'));
        }
    }

    public function add_questions($online_exam_id)
    {
        $teacher_id = OnlineExams::where('id', $online_exam_id)->pluck('teacher_id')->first();
        if (Auth::user()->role_id == 1 ) {
            $questions = Questions::all()->pluck('question_text', 'id');
            return view('online-exams.add_question', compact('questions', 'online_exam_id'));
        } elseif (Auth::user()->role_id == 6 && Auth::id() == $teacher_id) {
            $questions = Questions::where('added_by', Auth::id())->pluck('question_text', 'id');
            return view('online-exams.add_question', compact('questions', 'online_exam_id'));
        } else {
            return redirect()->back()->with('errors', trans('controller.online-exams.create_error'));
        }
    }

    public function store_questions(Request $request, $online_exam_id)
    {
        $teacher_id = OnlineExams::where('id', $online_exam_id)->pluck('teacher_id')->first();
        if (Auth::user()->role_id == 1  || (Auth::user()->role_id == 6 && Auth::id() == $teacher_id)) {
            $question = new OnlineExamsQuestions;
            $question->online_exam_id = $online_exam_id;
            $question->question_id = $request->question_id;
            $question->save();
            return redirect()->route('online-exams.questions', ['online_exam_id' => $online_exam_id])->with('success', trans('controller.online-exams.create_success'));
        } else {
            return redirect()->back()->with('errors', trans('controller.online-exams.create_error'));
        }
    }

    public function destroy_questions($online_exam_id, $id)
    {
        $teacher_id = OnlineExams::where('id', $online_exam_id)->pluck('teacher_id')->first();
        if (Auth::user()->role_id == 1  || (Auth::user()->role_id == 6 && Auth::id() == $teacher_id)) {
            $question = OnlineExamsQuestions::findOrFail($id);
            $question->delete();
            return redirect()->route('online-exams.questions', ['online_exam_id' => $online_exam_id])->with('success', trans('controller.online-exams.delete_success'));
        } else {
            return redirect()->back()->with('errors', trans('controller.online-exams.delete_error'));
        }
    }

    public function questions_options($online_exam_id, $question_id)
    {
        $teacher_id = OnlineExams::where('id', $online_exam_id)->pluck('teacher_id')->first();
        if (Auth::user()->role_id == 1  || (Auth::user()->role_id == 6 && Auth::id() == $teacher_id)) {
            $questions_options = Questions_Options::where('question_id', $question_id)->get();
            return view('online-exams.questions_options', compact('questions_options', 'online_exam_id'));
        } else {
            return redirect()->back()->with('errors', trans('controller.online-exams.view_error'));
        }
    }
}
