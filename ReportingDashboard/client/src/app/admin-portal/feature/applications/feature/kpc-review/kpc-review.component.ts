import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { BusyService } from 'src/app/shared/services/busy-service/busy.service';
import { DocumentsService } from 'src/app/shared/services/documents-service/documents.service';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-kpc-review',
  templateUrl: './kpc-review.component.html',
  styleUrls: ['./kpc-review.component.css'],
})
export class KpcReviewComponent implements OnInit {
  document: any;
  application: any;

  parcelInformationColumns = [
    {
      field: 'lineItem',

      headerText: 'HS CLASSIFICATION',

      textAlign: 'Left',
    },
    {
      field: 'number',

      headerText: 'CARATS',

      textAlign: 'Right',
    },
    {
      field: 'value',

      headerText: 'VALUE (USD)',

      textAlign: 'Right',
    },
  ];

  stateOptions: any[] = [
    { label: 'Reject', value: 'Reject' },
    { label: 'Approve', value: 'Approve' },
  ];

  constructor(
    private fb: FormBuilder,
    private busyService: BusyService,
    private preferencesService: PreferencesService,
    private documentsService: DocumentsService,
    private toastService: ToastrService,
    private routerService: Router
  ) {}

  reviewForm: FormGroup;

  ngOnInit(): void {
    this.initializeForm();

    if (this.document == null) {
      this.routerService.navigateByUrl('/admin-portal/applications');
    }

    if (this.document != null) {
      this.application = this.document.application;
    }
  }

  initializeForm() {
    this.reviewForm = this.fb.group({
      action: ['', Validators.required],
      reason: [''],
    });
  }

  formattedDate(_inputDate) {
    const inputDate = new Date(_inputDate);

    const day = inputDate.getUTCDate();
    const month = inputDate.getUTCMonth() + 1; // Months are zero-indexed, so add 1
    const year = inputDate.getUTCFullYear();

    const formattedDate = `${day.toString().padStart(2, '0')}/${month
      .toString()
      .padStart(2, '0')}/${year}`;

    return formattedDate;
  }

  review() {
    if (
      this.reviewForm.controls.action.value == 'Reject' &&
      this.reviewForm.controls.reason.value == ''
    ) {
      this.toastService.error(
        'You need to add a reason for rejecting the application.'
      );
      return;
    }

    this.busyService.busy();

    let reviewDto = {
      user: this.preferencesService.getPreferences().user,
      action: this.reviewForm.controls.action.value,
      reason: this.reviewForm.controls.reason.value,
      documentId: this.document.documentID,
    };

    this.documentsService.reviewCertificate(reviewDto).subscribe(
      (response: any) => {
        //Reload main page
        window.location.reload();
        //this.routerService.navigateByUrl('/admin-portal/applications');

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
