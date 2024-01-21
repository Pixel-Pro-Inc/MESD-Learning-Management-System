import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PsdlInformation1Component } from './psdl-information-1.component';

describe('PsdlInformation1Component', () => {
  let component: PsdlInformation1Component;
  let fixture: ComponentFixture<PsdlInformation1Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PsdlInformation1Component ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PsdlInformation1Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
