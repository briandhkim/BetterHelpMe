const CheckboxQuestion = ({ question, setData }) => {
	const { choices } = question;
	return (
		<div className='space-y-10'>
			<fieldset>
				<legend className='text-sm font-semibold leading-6 text-gray-900'>
					{question.title}
				</legend>
				<div className='mt-6 space-y-6'>
					{choices.map(choice => (
						<div key={choice.id} className='relative flex gap-x-3'>
							<div className='flex h-6 items-center'>
								<input
									id={`question-${question.id}-choice-${choice.id}`}
									name={`question-${question.id}`}
									type='checkbox'
									value={choice.value}
									onChange={e => {
										e.target.checked
											? setData(prevData => ({
													...prevData,
													[`question_${question.id}`]:
														[
															...prevData[
																`question_${question.id}`
															],
															choice.label,
														],
												}))
											: setData(prevData => ({
													...prevData,
													[`question_${question.id}`]:
														prevData[
															`question_${question.id}`
														].filter(
															label =>
																label !=
																choice.label
														),
												}));
									}}
									className='h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600'
								/>
							</div>
							<div className='text-sm leading-6'>
								<label
									htmlFor={`question-${question.id}-choice-${choice.id}`}
									className='font-medium text-gray-900'
								>
									{choice.label}
								</label>
							</div>
						</div>
					))}
				</div>
			</fieldset>
		</div>
	);
};

export default CheckboxQuestion;
