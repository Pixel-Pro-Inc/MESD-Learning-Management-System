import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { PreferencesService } from '../shared/services/preferences-service/preferences.service';
import { DocumentsService } from '../shared/services/documents-service/documents.service';
import { BusyService } from '../shared/services/busy-service/busy.service';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-verify',
  templateUrl: './verify.component.html',
  styleUrls: ['./verify.component.css'],
})
export class VerifyComponent implements OnInit {
  constructor(
    private fb: FormBuilder,
    private routerService: Router,
    private busyService: BusyService,
    private toastService: ToastrService,
    private documentsService: DocumentsService,
    private preferencesService: PreferencesService
  ) {}

  serviceForm: FormGroup;

  ngOnInit(): void {
    this.initializeForm();
  }

  initializeForm() {
    this.serviceForm = this.fb.group({
      cNumber: ['', Validators.required],
    });
  }

  formattedDate(inputDateString: string) {
    const inputDate = new Date(inputDateString);

    const day = inputDate.getUTCDate();
    const month = inputDate.getUTCMonth() + 1; // Months are zero-indexed, so add 1
    const year = inputDate.getUTCFullYear();

    const formattedDate = `${day.toString().padStart(2, '0')}/${month
      .toString()
      .padStart(2, '0')}/${year}`;

    return formattedDate;
  }

  document;
  searched = false;

  verify() {
    this.busyService.busy();

    this.documentsService
      .verifyDocument(this.serviceForm.controls.cNumber.value)
      .subscribe(
        (response: any) => {
          this.document = response;
          this.searched = true;
          this.busyService.idle();
        },
        (error) => {
          this.busyService.idle();
          this.toastService.error(
            'Something went wrong please try again and report the issue if it persists.',
            'Error'
          );
        }
      );
  }
}
