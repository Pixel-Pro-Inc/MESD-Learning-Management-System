import { ComponentFixture, TestBed } from '@angular/core/testing';

import { RoughDiamondReviewComponent } from './rough-diamond-review.component';

describe('RoughDiamondReviewComponent', () => {
  let component: RoughDiamondReviewComponent;
  let fixture: ComponentFixture<RoughDiamondReviewComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ RoughDiamondReviewComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(RoughDiamondReviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
