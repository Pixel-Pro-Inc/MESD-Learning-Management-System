import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { AccountService } from 'src/app/shared/services/account-service/account.service';
import { BusyService } from 'src/app/shared/services/busy-service/busy.service';

@Component({
  selector: 'app-token-request',
  templateUrl: './token-request.component.html',
  styleUrls: ['./token-request.component.css'],
})
export class TokenRequestComponent implements OnInit {
  constructor(
    private fb: FormBuilder,
    private accountService: AccountService,
    private toastService: ToastrService,
    private busyService: BusyService,
    private routerService: Router
  ) {}

  tokenForm: FormGroup;

  ngOnInit(): void {
    this.initializeForm();
  }

  initializeForm() {
    this.tokenForm = this.fb.group({
      accountID: ['', [Validators.required]],
    });
  }

  tokenRequest() {
    this.busyService.busy();

    this.accountService
      .tokenRequest(this.tokenForm.controls.accountID.value)
      .subscribe(
        (response) => {
          this.busyService.idle();

          this.routerService.navigateByUrl(
            '/password-reset/reset?accountID=' +
              this.tokenForm.controls.accountID.value
          );
        },
        (error) => {
          this.busyService.idle();
          this.toastService.error(
            'An error has occured please try again and report the issue if it persists.',
            'Error'
          );
        }
      );
  }
}
