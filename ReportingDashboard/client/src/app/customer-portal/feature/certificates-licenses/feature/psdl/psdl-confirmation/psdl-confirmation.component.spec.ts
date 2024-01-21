import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PsdlConfirmationComponent } from './psdl-confirmation.component';

describe('PsdlConfirmationComponent', () => {
  let component: PsdlConfirmationComponent;
  let fixture: ComponentFixture<PsdlConfirmationComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PsdlConfirmationComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PsdlConfirmationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
