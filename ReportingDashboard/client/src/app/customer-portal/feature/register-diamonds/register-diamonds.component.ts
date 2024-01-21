import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { BusyService } from 'src/app/shared/services/busy-service/busy.service';
import { DocumentsService } from 'src/app/shared/services/documents-service/documents.service';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-register-diamonds',
  templateUrl: './register-diamonds.component.html',
  styleUrls: ['./register-diamonds.component.css'],
})
export class RegisterDiamondsComponent implements OnInit {
  constructor(
    private fb: FormBuilder,
    private routerService: Router,
    private toastService: ToastrService,
    private busyService: BusyService,
    private documentsService: DocumentsService,
    private preferencesService: PreferencesService
  ) {}

  serviceForm: FormGroup;

  ngOnInit(): void {
    this.initializeForm();
  }

  initializeForm() {
    this.serviceForm = this.fb.group({
      service: ['Rough Diamond Certificate'],
      diamondCuttingLicense: ['', Validators.required],
      diamondType: ['', Validators.required],
      diamondWeight: ['', Validators.required],
      diamondColorGrade: ['', Validators.required],
      diamondClarityGrade: ['', Validators.required],
      diamondDimensions: ['', Validators.required],
      diamondSource: ['', Validators.required],
      diamondOriginCountry: ['', Validators.required],
    });
  }

  next() {
    this.busyService.busy();

    let prefs = this.preferencesService.getPreferences();

    let applicationModel = {
      user: prefs.user,
      application: this.serviceForm.value,
    };

    this.documentsService.applyCertificate(applicationModel).subscribe(
      (response) => {
        //Clear form data
        //Clear steps menu
        prefs.certFormsPersistence = null;
        prefs.currentCertFormSelected = null;

        this.preferencesService.setPreferences(prefs);

        //Navigate to documents page
        this.routerService.navigateByUrl('/portal/my-applications');

        this.busyService.idle();
      },
      (error) => {
        this.busyService.idle();
        this.toastService.error(error.error, 'Error');
      }
    );
  }
}
