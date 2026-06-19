<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\OpdVisitController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PharmacyBillController;
use App\Http\Controllers\LabTestController;
use App\Http\Controllers\LabOrderController;
use App\Http\Controllers\LabResultController;
use App\Http\Controllers\LabReportController;
use App\Http\Controllers\WardController;
use App\Http\Controllers\BedController;
use App\Http\Controllers\IpdAdmissionController;
use App\Http\Controllers\IpdVitalController;
use App\Http\Controllers\IpdRoundController;
use App\Http\Controllers\DoctorOrderController;
use App\Http\Controllers\IpdMedicationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\RadiologyTestController;
use App\Http\Controllers\DoctorScheduleSessionController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\DietController;
use App\Http\Controllers\FollowupController;
use App\Http\Controllers\DoctorDashboardController;


Route::get('/', function () {
return redirect('/login');
});

Route::middleware('auth')->group(function () {

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');; 

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::resource('users', UserController::class);
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/roles/{role}/permissions',
[RoleController::class,'permissions'])
->name('roles.permissions');
Route::post('/roles/{role}/permissions',
[RoleController::class,'updatePermissions'])
->name('roles.permissions.update');
Route::resource('patients', PatientController::class);
Route::resource('doctors',DoctorController::class);
Route::resource('doctor-schedules',DoctorScheduleController::class);
Route::get('/appointments/slots', [AppointmentController::class, 'getSlots'])
->name('appointments.slots');

Route::get('/appointments/{id}/print', [AppointmentController::class, 'print'])
->name('appointments.print');

Route::get('/appointments/{id}/pdf', [AppointmentController::class, 'pdf'])
->name('appointments.pdf');

Route::resource('appointments', AppointmentController::class);


// 📋 List (Reception + Doctor)
Route::get('opd/', [OpdVisitController::class, 'index'])
->name('opd.index');

// 🔄 Create from Appointment (Check-in)
Route::get('opd/create-from-appointment/{id}', [OpdVisitController::class, 'createFromAppointment'])
->name('opd.create.from.appointment');

Route::get('/opd/{visit}/print-token',[OpdVisitController::class, 'printToken']
)->name('opd.print-token');

// 👁️ Show single visit
Route::get('opd/show/{id}', [OpdVisitController::class, 'show'])
->name('opd.show');

// 👨‍⚕️ Start consultation (Doctor)
Route::get('opd/start/{id}', [OpdVisitController::class, 'startConsultation'])
->name('opd.start');

Route::get('/opd/consult/{id}', [OpdVisitController::class, 'consult'])
->name('opd.consult');


// ✅ Complete visit (Doctor)
Route::get('opd/complete/{id}', [OpdVisitController::class, 'complete'])
->name('opd.complete');

Route::get('/opd/{id}/print', [OpdVisitController::class, 'print'])
->name('opd.print');

Route::post('/consultations/{visit}',[ConsultationController::class, 'store']
)->name('consultations.store');
Route::resource('medicines', MedicineController::class);
Route::resource('pharmacy-bills', PharmacyBillController::class);

Route::get(
'/pharmacy-queue',
[PharmacyBillController::class,'queue']
)->name('pharmacy.queue');

Route::get(
'/pharmacy-bills/create-from-opd/{id}',
[PharmacyBillController::class,'createFromOpd']
)->name('pharmacy.create.from.opd');

Route::get(
'/pharmacy-bills/payment/{id}',
[PharmacyBillController::class,'payment']
)->name('pharmacy.payment');

Route::get(
'/pharmacy-bills/dispense/{id}',
[PharmacyBillController::class,'dispense']
)->name('pharmacy.dispense');

Route::get(
'/pharmacy-bills/print/{id}',
[PharmacyBillController::class,'print']
)->name('pharmacy.print');

Route::resource(
'pharmacy-bills',
PharmacyBillController::class
);

Route::resource('lab-tests', LabTestController::class);
Route::get('lab-orders/', [LabOrderController::class,'index']);
Route::get('lab-orders/pending', [LabOrderController::class,'pending']);

Route::post('lab-orders/processing/{id}', [LabOrderController::class,'processing']);
Route::post('lab-orders/complete/{id}', [LabOrderController::class,'complete']);
Route::get('/lab-results/create/{id}', [LabResultController::class,'create']);
Route::post('/lab-results/store/{id}', [LabResultController::class,'store']);
Route::get('/lab-orders/{id}', [LabOrderController::class,'show']);
Route::get('/lab-reports', [LabReportController::class, 'index']);
Route::get('/lab-reports/{id}', [LabReportController::class, 'show']);
Route::get('/lab-reports/print/{id}', [LabReportController::class, 'print']);
Route::resource('wards', WardController::class);
Route::resource('beds', BedController::class);
Route::get(
'/ipd/admissions',
[IpdAdmissionController::class, 'index']
)->name('ipd.admissions.index');

Route::get(
'/ipd/admissions/create/{visit}',
[IpdAdmissionController::class, 'create']
)->name('ipd.admissions.create');

Route::get(
'/ipd/admissions/{id}/edit',
[IpdAdmissionController::class, 'edit']
)->name('ipd.admissions.edit');

Route::put(
'/ipd/admissions/{id}',
[IpdAdmissionController::class, 'update']
)->name('ipd.admissions.update');


Route::delete('/ipd/admissions/{id}', [IpdAdmissionController::class, 'destroy'])
->name('ipd.admissions.destroy');

Route::post(
'/ipd/admissions',
[IpdAdmissionController::class, 'store']
)->name('ipd.admissions.store');

Route::get(
'/ipd/admissions/{admission}',
[IpdAdmissionController::class, 'show']
)->name('ipd.admissions.show');


Route::get(
'/ipd/admissions/{id}/print',
[IpdAdmissionController::class, 'print']
)->name('ipd.admissions.print');


Route::get(
'/ipd/admissions/{admission}/vitals',
[IpdVitalController::class,'index']
)->name('ipd.vitals.index');

Route::get(
'/ipd/admissions/{admission}/vitals/create',
[IpdVitalController::class,'create']
)->name('ipd.vitals.create');

Route::post(
'/ipd/admissions/{admission}/vitals',
[IpdVitalController::class,'store']
)->name('ipd.vitals.store');


Route::get(
'/ipd/admissions/{admission}/rounds',
[IpdRoundController::class,'index']
)->name('ipd.rounds.index');

Route::get(
'/ipd/admissions/{admission}/rounds/create',
[IpdRoundController::class,'create']
)->name('ipd.rounds.create');

Route::post(
'/ipd/admissions/{admission}/rounds',
[IpdRoundController::class,'store']
)->name('ipd.rounds.store');

Route::get(
'/ipd/admissions/{admission}/orders',
[DoctorOrderController::class,'index']
)->name('ipd.orders.index');

Route::get(
'/ipd/admissions/{admission}/orders/create',
[DoctorOrderController::class,'create']
)->name('ipd.orders.create');

Route::post(
'/ipd/admissions/{admission}/orders',
[DoctorOrderController::class,'store']
)->name('ipd.orders.store');


Route::post(
'/ipd/orders/{order}/status',
[DoctorOrderController::class,'updateStatus']
)->name('ipd.orders.status');


Route::get(
'/ipd/admissions/{admission}/medications',
[IpdMedicationController::class, 'index']
)->name('ipd.medications.index');


Route::post(
'/ipd/medications/{order}/activate',
[IpdMedicationController::class, 'storeFromOrder']
)->name('ipd.medications.activate');


Route::post(
'/ipd/medications/{id}/give',
[IpdMedicationController::class, 'giveDose']
)->name('ipd.medication.give');

Route::resource('departments', DepartmentController::class);
Route::get('/departments/toggle/{id}', [DepartmentController::class, 'toggle'])
->name('departments.toggle');

Route::view('/settings', 'settings.index')
->name('settings.index');

Route::post('/settings',
[SettingController::class,'update'])
->name('settings.update');

Route::resource('radiology-tests', RadiologyTestController::class);
Route::resource(
'doctor-schedules.sessions',
DoctorScheduleSessionController::class
);

Route::resource('procedures', ProcedureController::class);
Route::resource('diets', DietController::class);
Route::get('/print/opd/prescription/{id}', [PrintController::class, 'prescription'])->name('opd.prescription.print');

Route::get('/print/opd/lab/{id}', [PrintController::class, 'lab'])->name('opd.lab.print');

Route::get('/print/opd/radiology/{id}', [PrintController::class, 'radiology'])->name('opd.radiology.print');

Route::get('/print/opd/procedure/{id}', [PrintController::class, 'procedure'])
->name('opd.procedure.print');

Route::get('/followups', [FollowupController::class, 'index'])
    ->name('followups.index');

Route::get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('doctor.dashboard');




});

require __DIR__.'/auth.php';
